<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAdmin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    protected array $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    protected array $errorMessage = [
        'email.email' => 'Email não válido.',
        'email.required' => "O campo email é obrigatório",
        'password.required' => "O campo senha é obrigatório"
    ];

    public function loginBackOffice(): View|Factory|RedirectResponse|Application
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('backoffice.index');
        }

        return view('backoffice.login');
    }

    public function authBackOffice(Request $request): RedirectResponse
    {
        $credentials = $request->validate($this->rules, $this->errorMessage);
        $remember = $request->get('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)){
            $request->session()->regenerate();

            return redirect()->route('backoffice.index');
        }

        return back()->withErrors([
            'password' => 'E-mail ou senha incorretos.',
        ])->onlyInput('password');
    }

    public function logoutBackOffice(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::guard('admin')->logout();

        // $request->session()->invalidate();
        //
        // $request->session()->regenerateToken();

        return redirect('/backoffice/login');
    }


    public function loginSite(): View|Factory|RedirectResponse|Application
    {
        if (Auth::check()) {
            return redirect()->route('site.index');
        }

        return view('site.login');
    }

    public function authSite(Request $request): RedirectResponse
    {
        $credentials = $request->validate($this->rules, $this->errorMessage);
        $remember = $request->get('remember');

        if (Auth::guard()->attempt($credentials, $remember)){
            $request->session()->regenerate();

            return redirect()->route('site.index');
        }

        return back()->withErrors([
            'password' => 'E-mail ou senha incorretos.',
        ])->onlyInput('password');
    }

    public function logoutSite(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();
        //
        // $request->session()->invalidate();
        //
        // $request->session()->regenerateToken();

        return redirect('/login');
    }


}
