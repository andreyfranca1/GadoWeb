<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VacinasController extends Controller
{

    public function index(): Factory|View|Application
    {
        return View('site.vacinas.index');
    }
}
