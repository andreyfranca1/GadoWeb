<?php

namespace App\Http\Controllers;

use App\Models\Flock;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class RebanhosController extends Controller
{
    public function index(): Factory|View|Application
    {
        $rebanhos = Flock::query()->where('company_id', '=', Auth::user()['company_id'])->get();

        return View('site.rebanhos.index', ['rebanhos' => $rebanhos]);
    }

    public function novoRebanho(Request $request): RedirectResponse
    {
        try {
            $rebanho = new Flock();

            $rebanho->company_id = Auth::user()['company_id'];
            $rebanho->name = $request['name'];
            $rebanho->description = $request['description'];

            $rebanho->save();
        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar rebanho.']);

        }

        return back()->with('success', 'Rebanho cadastrado com sucesso');
    }
}
