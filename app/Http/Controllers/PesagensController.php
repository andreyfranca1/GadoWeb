<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesagensController extends Controller
{
    public function index()
    {
        return View('site.pesagens.index');
    }
}
