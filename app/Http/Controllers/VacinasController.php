<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VacinasController extends Controller
{
    
    public function listVacinas()
    {
        return View('site.vacinas.index');
    }
}
