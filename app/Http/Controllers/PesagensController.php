<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesagensController extends Controller
{
    public function listPesagens()
    {
        return View('site.pesagens.index');
    }
}
