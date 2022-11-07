<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function index(): Factory|View|Application
    {
        $users = User::all()->where('company_id', Auth::user()['company_id']);
        $count = count($users);

        return view('site.users.index', ['users' => $users, 'count' => $count]);
    }

    public function novoUsuario(Request $request): RedirectResponse
    {
        $rules = [
            'name' => ['required'],
            'cpf' => ['required'],
            'cellphone' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'passwordConfirm' => ['required']
        ];

        $errorMessage = [
            'name.required' => 'Informe o nome do usuário.',
            'cpf.required' => 'Informe o CPF do usuário.',
            'cellphone.required' => 'Informe o celular do usuário.',
            'email.required' => 'Informe o email do usuário.',
            'email.email' => 'Informe um email válido para usuário.',
            'password.required' => 'O campo senha é obrigatório',
            'passwordConfirm.required' => 'Necessário confirmação da senha'
        ];

        $request->validate($rules, $errorMessage);

        $request['cpf'] = removeCaracteres($request['cpf']);

        if (!validaCPF($request['cpf'])) {
            return back()->withErrors(['CPF Inválido para o cadastro do usuário.']);
        }

        if (User::query()->where('cpf', $request['cpf'])->get()->toArray()) {
            return back()->withErrors(['CPF já cadastrado para outro usuário.']);
        }

        if (User::query()->where('email', $request['email'])->get()->toArray()) {
            return back()->withErrors(['E-mail já cadastrado para outro usuário.']);
        }

        if ($request['password'] != $request['passwordConfirm']) {
            return back()->withErrors(['As senhas não coincidem.']);
        }


        try {
            $usuario = new User();

            $usuario->name = $request['name'];
            $usuario->company_id = Auth::user()['company_id'];
            $usuario->email = $request['email'];
            $usuario->password = Hash::make($request['password']);
            $usuario->cpf = $request['cpf'];
            $usuario->phone = removeCaracteres($request['phone']);

            $usuario->save();
        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar usuário.']);
        }

        return back()->with('success', 'Usuário cadastrado com sucesso');
    }
}
