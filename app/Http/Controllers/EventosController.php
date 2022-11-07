<?php

namespace App\Http\Controllers;

use App\Models\Flock;
use App\Models\Food;
use App\Models\FoodEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class EventosController extends Controller
{

    public function listEventosAlimentacao()
    {

        $eventos = FoodEvent::query()
            ->leftJoin('flocks', 'food_events.flock_id', '=', 'flocks.id')
            ->where('flocks.company_id', Auth::user()['company_id'])
            ->select('flocks.name as flock_name', 'food_events.start_date', 'food_events.end_date')
            ->get()->toArray();

        $alimentos = Food::query()->where('company_id', Auth::user()['company_id'])->get()->toArray();
        $rebanhos = Flock::query()->where('company_id', Auth::user()['company_id'])->get()->toArray();

        return view('site.eventos.eventosAlim.index', [
            'eventos'   => $eventos,
            'alimentos' => $alimentos,
            'rebanhos'  => $rebanhos,
        ]);
    }

    public function novoEventoAlimentacao(Request $request)
    {
        if ($request['start_date'] > $request['end_date']) {
            return back()->withErrors(['A data final precisa ser maior que a data inicial!']);
        }

        try {
            $evento = new FoodEvent();

            $evento->flock_id = $request['rebanho'];
            $evento->description = $request['descricao'];
            $evento->start_date = $request['start_date'];
            $evento->end_date = $request['end_date'];

            $evento->save();

            foreach ($request['alimentos'] as $alimento) {
                DB::table('food_event_items')->insert([
                    'event_id' => $evento->id,
                    'food_id' => $alimento
                ]);
            }

        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar evento!']);
        }

        return back()->with('success', 'Evento cadastrado com sucesso');
    }

    public function listEventosMedicacao()
    {
        return view('site.eventos.eventosMed.index');
    }

    public function listEventosVacinacao()
    {
        return view('site.eventos.eventosVac.index');
    }

}
