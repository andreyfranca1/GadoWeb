<?php

namespace App\Http\Controllers;

use App\Models\Flock;
use App\Models\Food;
use App\Models\FoodEvent;
use App\Models\MedicationEvent;
use App\Models\Medicine;
use App\Models\VaccinationEvent;
use App\Models\Vaccine;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
        $eventos = MedicationEvent::query()
            ->leftJoin('flocks', 'medication_events.flock_id', '=', 'flocks.id')
            ->where('flocks.company_id', Auth::user()['company_id'])
            ->select('flocks.name as flock_name', 'medication_events.start_date', 'medication_events.end_date')
            ->get()->toArray();

        $medicamentos = Medicine::query()->where('company_id', Auth::user()['company_id'])->get()->toArray();
        $rebanhos = Flock::query()->where('company_id', Auth::user()['company_id'])->get()->toArray();

        return view('site.eventos.eventosMed.index', [
            'eventos' => $eventos,
            'medicamentos' => $medicamentos,
            'rebanhos' => $rebanhos
        ]);
    }

    public function novoEventoMedicacao(Request $request)
    {
        if ($request['start_date'] > $request['end_date']) {
            return back()->withErrors(['A data final precisa ser maior que a data inicial!']);
        }

        try {
            $evento = new MedicationEvent();

            $evento->flock_id = $request['rebanho'];
            $evento->description = $request['descricao'];
            $evento->start_date = $request['start_date'];
            $evento->end_date = $request['end_date'];

            $evento->save();

            foreach ($request['medicamentos'] as $medicamento) {
                DB::table('medication_event_items')->insert([
                    'event_id' => $evento->id,
                    'medicine_id' => $medicamento
                ]);
            }

        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar evento!']);
        }

        return back()->with('success', 'Evento cadastrado com sucesso');
    }

    public function listEventosVacinacao()
    {
        $eventos = VaccinationEvent::query()
            ->leftJoin('flocks', 'vaccination_events.flock_id', '=', 'flocks.id')
            ->leftJoin('vaccination_event_items', 'vaccination_event_items.event_id', 'vaccination_events.id')
            ->leftJoin('vaccines', 'vaccination_event_items.vaccine_id', 'vaccines.id')
            ->where('flocks.company_id', Auth::user()['company_id'])
            ->select('flocks.name as flock_name', 'vaccination_events.date', 'vaccines.name as vaccine_name', 'vaccination_events.vet')
            ->get()->toArray();

        $vacinas = Vaccine::query()->where('company_id', Auth::user()['company_id'])->get()->toArray();
        $rebanhos = Flock::query()->where('company_id', Auth::user()['company_id'])->get()->toArray();

        return view('site.eventos.eventosVac.index', [
            'eventos' => $eventos,
            'vacinas' => $vacinas,
            'rebanhos' => $rebanhos
        ]);
    }

    public function novoEventoVacinacao(Request $request)
    {
        try {
            $evento = new VaccinationEvent();

            $evento->flock_id = $request['rebanho'];
            $evento->application_type = $request['aplicacao'];
            $evento->batch = $request['lote'];
            $evento->vet = $request['vet'];
            $evento->description = $request['descricao'];
            $evento->date = $request['date'];

            $evento->save();

            DB::table('vaccination_event_items')->insert([
                'event_id' => $evento->id,
                'vaccine_id' => $request['vacina']
            ]);


        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar evento!']);

        }

        return back()->with('success', 'Evento cadastrado com sucesso');
    }
}
