<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlimentosController extends Controller
{
    public function listAlimentos()
    {
        return View('site.alimentos.index');
    }
}
