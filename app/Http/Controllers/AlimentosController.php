<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AlimentosController extends Controller
{
    public function listAlimentos()
    {
        $alimentos = new Food();

        $alimentos = $alimentos->query()->where('company_id', '=', Auth::user()->company_id)->get();

        return View('site.alimentos.index', ["alimentos" => $alimentos]);
    }

    public function addAlimento(Request $request)
    {
        $alimento = $request->toArray();

        try{
            $food = New Food();
            
            $food->company_id = Auth::user()->company_id;
            $food->name = $alimento['nomeAlimento'];
            $food->type = $alimento['tipoAlimento'];
            $food->description = $alimento['descricao'];
    
            $food->save();
        }catch(Throwable $e){
            return back()->withErrors(['Erro ao cadastrar Alimento']);
        }

        return back()->with('success', 'Alimento cadastrado com sucesso');
    }
}
