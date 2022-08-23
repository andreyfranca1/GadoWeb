<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginBackOffice()
    {
        return view('login.index');
    }
}
