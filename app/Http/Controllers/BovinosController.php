<?php

namespace App\Http\Controllers;

use App\Models\Breed;
use App\Models\Cattle;
use App\Models\Flock;
use App\Models\Weighing;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class BovinosController extends Controller
{
    
    public function index(): Factory|View|Application
    {
        $gados = Cattle::query()
        ->leftJoin('flocks', 'cattle.flock_id', '=','flocks.id')
        ->leftJoin('breeds', 'cattle.breed_id', '=', 'breeds.id')
        ->where('cattle.company_id', Auth::user()['company_id'])
        ->select('cattle.id', 'cattle.name', 'cattle.bovine_earring_id', 'breeds.name as breed_name', 'flocks.name as flock_name')
        ->get()->toArray();
        
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
        
        
        foreach ($gados as &$gado) {
            $gado['peso'] = Weighing::query()->where('cattle_id', $gado['id'])->latest()->limit(1)->get()->value('weight');
        }
        
        return view('site.bovinos.index', [
            'gados' => $gados,
            'rebanhos' => $rebanhos,
            'racas' => $racas,
            'pais' => $pais,
            'maes' => $maes
        ]);
    }
    
    public function  novoBovino(): Factory|View|Application
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
    
    public function cadastarBovino(Request $request): RedirectResponse
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
        
        $bovinosMachos = Cattle::select(DB::raw('count(*) as total'))->where('company_id', '=', Auth::user()['company_id'])
        ->where('sex', '=', 1)
        ->get();
        $bovinosFemeas = Cattle::select(DB::raw('count(*) as total'))->where('company_id', '=', Auth::user()['company_id'])
        ->where('sex', '=', 0)
        ->get();
        
        
        $bovinos = [
            'machos' => $bovinosMachos->first()->total,
            'femeas' => $bovinosFemeas->first()->total
        ];
        
        echo json_encode($bovinos);
    }
    
    public function getBovinoById(Request $request)
    {
        $request = $request->toArray();
        
        $bovino = Cattle::query()->where('id', '=', $request['id'])->get();
        
        $pesagens = Weighing::query()->select(DB::raw('weight, DATE_FORMAT(created_at, "%d/%m/%Y") as data'))->where('cattle_id', '=', $request['id'])
        ->orderBy('created_at', 'DESC')->limit(5)
        ->get();
        
        
        $data = [
            'bovino' => $bovino->first()->toArray(),
            'pesagens' => $pesagens->toArray()
        ];
        echo json_encode($data);
    }
}
