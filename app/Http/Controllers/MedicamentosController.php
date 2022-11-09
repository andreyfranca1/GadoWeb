<?php

namespace App\Http\Controllers;


use App\Models\Medicine;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class MedicamentosController extends Controller
{
    public function index(): Factory|View|Application
    {
        $medicamento = new Medicine();

        $medicamento = $medicamento->query()->where('company_id', '=', Auth::user()->company_id)->get();

        return View("site.medicamentos.index", ['medicamentos' => $medicamento]);
    }

    public function addMedicamento(Request $request): RedirectResponse
    {
        $medicamento = $request->toArray();

        try{
            $medicine = New Medicine();

            $medicine->company_id = Auth::user()->company_id;
            $medicine->name = $medicamento['nomeMedicamento'];
            $medicine->description = $medicamento['descricao'];

            $medicine->save();

        }catch(Throwable $e){
            return back()->withErrors(['Erro ao cadastrar Medicamento']);
        }

        return back()->with('success', 'Medicamento cadastrado com sucesso');
    }

    public function excluirMedicamento($id): RedirectResponse
    {
        try {
            DB::table('medicines')->delete($id);
        } catch (Throwable $t) {
            return back()->withErrors(['Não permitido excluir medicamentos já vinculadas a eventos.']);
        }

        return back()->with('success', 'Medicamento deletado com sucesso!');
    }
}
