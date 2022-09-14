<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAdmin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    protected $errorMessage = [
        'email.email' => "O campo email é obrigatório",
        'password.required' => "O campo senha é obrigatório"
    ];

    public function loginBackOffice()
    {
        return view('backoffice.login');
    }

    public function authBackOffice(Request $request)
    {
        $this->validate($request, $this->rules);


        $creds = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::guard('user_admin')->attempt($creds)){

            return redirect()->route('backoffice.index');
        }else{
            dd('auth failed');
        }
    }
}
