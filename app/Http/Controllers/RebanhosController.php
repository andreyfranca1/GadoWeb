<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RebanhosController extends Controller
{
    public function listRebanhos()
    {
        return View('site.rebanhos.index');
    }
}
