<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Cattle;
use App\Models\Flock;
use App\Models\Weighing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class BovinosController extends Controller
{

    public function index()
    {
        return view('site.bovinos.index');
    }

    public function  novoBovino()
    {
        $rebanhos = Flock::query()->where('company_id', '=', Auth::user()['company_id'])->get();
        $racas = Breed::all();
        $pais = Cattle::query()
            ->where('company_id', '=', Auth::user()['company_id'])
            ->where('sex', '=', '1')
            ->get();
        $maes = Cattle::query()
            ->where('company_id', '=', Auth::user()['company_id'])
            ->where('sex', '=', '0')
            ->get();

        return view('site.bovinos.addBovino', [
            'rebanhos' => $rebanhos,
            'racas' => $racas,
            'pais' => $pais,
            'maes' => $maes
        ]);
    }

    public function cadastarBovino(Request $request)
    {
        try {
            $bovino = new Cattle();
            $pesagem = new Weighing();

            $bovino->company_id = Auth::user()['company_id'];
            $bovino->bovine_earring_id = $request['idBrinco'];
            $bovino->association_id = $request['idAssoc'];
            $bovino->flock_id = $request['idRebanho'];
            $bovino->breed_id = $request['idRaca'];
            $bovino->mother_id = $request['idMae'];
            $bovino->father_id = $request['idPai'];
            $bovino->name = $request['name'];
            $bovino->category = $request['categoria'];
            $bovino->sex = $request['sexo'];
            $bovino->born_date = $request['born_date'];

            $bovino->save();

            $pesagem->cattle_id = $bovino->id;
            $pesagem->weight = $request['peso'];
            $pesagem->description = "Primeira pesagem";

            $pesagem->save();

        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar bovino.']);
        }

        return back()->with('success', 'Bovino cadastrado com sucesso');
    }

    public function getBovinosByGender(){

        $bovinos = Cattle::select('sex', DB::raw('count(*) as total'))->where('company_id', '=', Auth::user()['company_id'])
            ->groupby('sex')
            ->get();

        echo json_encode($bovinos->toArray());
    }
}
