<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicamentosController extends Controller
{
    public function listMedicamentos()
    {
        return View("site.medicamentos.index");
    }
}
