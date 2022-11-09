<?php

namespace App\Http\Controllers;


use App\Models\Food;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class AlimentosController extends Controller
{
    public function index(): Factory|View|Application
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

    public function excluirAlimento($id): RedirectResponse
    {
        try {
            DB::table('foods')->delete($id);
        } catch (Throwable $t) {
            return back()->withErrors(['Não permitido excluir alimento já vinculado a eventos.']);
        }

        return back()->with('success', 'Alimento deletado com sucesso!');
    }
}
