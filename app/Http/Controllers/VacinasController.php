<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VacinasController extends Controller
{

    public function index()
    {
        return View('site.vacinas.index');
    }
}
