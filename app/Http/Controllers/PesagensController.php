<?php

namespace App\Http\Controllers;

use App\Models\Cattle;
use App\Models\Weighing;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PesagensController extends Controller
{
    public function index(): Factory|View|Application
    {
        $pesagens = Weighing::query()
            ->leftJoin('cattle', 'weighings.cattle_id', '=', 'cattle.id')
            ->where('cattle.company_id', '=', Auth::user()['company_id'])
            ->select('weighings.*', 'cattle.bovine_earring_id', 'cattle.name')
            ->get()->toArray();

        return View('site.pesagens.index', ['pesagens' => $pesagens]);
    }

    public function novaPesagem(Request $request): RedirectResponse
    {
        $gado = Cattle::query()
            ->where('bovine_earring_id', '=', $request['idBrinco'])
            ->where('company_id', '=', Auth::user()['company_id'])
            ->first();

        if (!$gado) {
            return back()->withErrors(['Nenhum boi encontrado para ID do brinco informado.']);
        }

        try {
            $pesagem = new Weighing();

            $pesagem->cattle_id = $gado['id'];
            $pesagem->weight = $request['peso'];
            $pesagem->description = $request['descricao'];

            $pesagem->save();
        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar pesagem.']);
        }

        return back()->with('success', 'Pesagem cadastrada com sucesso.');
    }
}
