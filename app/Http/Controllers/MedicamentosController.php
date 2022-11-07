<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class MedicamentosController extends Controller
{
    public function index()
    {
        $medicamento = new Medicine();

        $medicamento = $medicamento->query()->where('company_id', '=', Auth::user()->company_id)->get();

        return View("site.medicamentos.index", ['medicamentos' => $medicamento]);
    }

    public function addMedicamento(Request $request)
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
}
