<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAdmin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function loginBackOffice(): Factory|View|Application
    {
        return view('backoffice.login');
    }

    public function authBackOffice(Request $request)
    {
        $authRule = [
           'email' => 'email',
           'password' => 'required'
        ];

        $feedback = [
            'email.email' => "O campo email é obrigatório",
            'password.required' => "O campo senha é obrigatório"
        ];

        $request->validate($authRule, $feedback);

        $email = $request->get('email');
        $password = $request->get('password');

        $UserAdmin = UserAdmin::query()
            ->where('email', $email)
            ->where('password', $password)
            ->get()
            ->first();

        // if ($UserAdmin) {
        //
        // }

        dd($UserAdmin);
    }
}
