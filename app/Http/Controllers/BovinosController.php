<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BovinosController extends Controller
{
    
    public function listBovinos()
    {
        return view('site.bovinos.index');
    }
}