<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventosController extends Controller
{

    public function listEventosAlimentacao()
    {
        return view('site.eventos.eventosAlim.index');
    }

    public function listEventosMedicacao()
    {
        return view('site.eventos.eventosMed.index');
    }

    public function listEventosVacinacao()
    {
        return view('site.eventos.eventosVac.index');
    }
    
}
