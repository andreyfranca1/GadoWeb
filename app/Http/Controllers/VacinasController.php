<?php

namespace App\Http\Controllers;

use App\Models\Vaccine;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class VacinasController extends Controller
{

    public function index(): Factory|View|Application
    {
        $vacinas = Vaccine::query()->where('company_id', Auth::user()['company_id'])->get()->toArray();

        return View('site.vacinas.index', ['vacinas' => $vacinas]);
    }

    public function novaVacina(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $vacina = new Vaccine();

            $vacina->company_id = Auth::user()['company_id'];
            $vacina->name = $request['nomeVacina'];
            $vacina->description = $request['descricao'];

            $vacina->save();
        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar vacina.']);
        }

        return back()->with('success', 'Vacina cadastrada com sucesso.');
    }
}
