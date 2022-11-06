<?php

namespace App\Http\Controllers;

use App\Models\Company;
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
use Session;

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
            session()->put('userName', Auth::guard('admin')->user()->name);
            session()->put('userEmail', Auth::guard('admin')->user()->email);
            return redirect()->route('backoffice.index');
        }

        return back()->withErrors([
            'password' => 'E-mail ou senha incorretos.',
        ])->onlyInput('password');
    }

    public function logoutBackOffice(): Redirector|Application|RedirectResponse
    {
        Auth::guard('admin')->logout();

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
            $company = Company::query()
                ->where('id', '=', Auth::user()['company_id'])
                ->get('status')
                ->first();

            if ($company['status'] == 0) {
                Auth::logout();

                return back()->withErrors([
                    'Empresa bloqueada, para mais informações entre em contato com o administrador!',
                ]);
            }


            session()->put('userName', Auth::user()->name);
            session()->put('userEmail', Auth::user()->email);
            return redirect()->route('site.index');
        }

        return back()->withErrors([
            'password' => 'E-mail ou senha incorretos.',
        ])->onlyInput('password');
    }

    public function logoutSite(): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        return redirect('/login');
    }


}
