<?php

namespace App\Http\Controllers;

use App\Models\UserAdmin;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserAdminController extends Controller
{
    public function index(): Factory|View|Application
    {
        $users = UserAdmin::all();
        $count = count($users);

        return view('backoffice.users.index', ['users' => $users, 'count' => $count]);
    }

    public function newUser(Request $request): \Illuminate\Http\RedirectResponse
    {
        $rules = [
            'name' => ['required'],
            'cpf' => ['required'],
            'cellphone' => ['required'],
            'cep' => ['required'],
            'address' => ['required'],
            'number' => ['required'],
            'district' => ['required'],
            'city' => ['required'],
            // 'state' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'passwordConfirm' => ['required']
        ];

        $errorMessage = [
            'name.required' => 'Informe o nome do usuário.',
            'cpf.required' => 'Informe o CPF do usuário.',
            'cellphone.required' => 'Informe o celular do usuário.',
            'cep.required' => 'Cep não informado.',
            'address.required' => 'Informe a rua do usuário.',
            'number.required' => 'Informe o número do endereço do usuário.',
            'district.required' => 'Informe o bairro do endereço do usuário.',
            'city.required' => 'Informe a cidade do usuário.',
            // 'state.required' => 'Informe o estado do usuário.',
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

        if ($request['password'] != $request['passwordConfirm']) {
            return back()->withErrors(['As senhas não coincidem.']);
        }

        try {
            $userAdmin = new UserAdmin();

            $userAdmin->name = $request['name'];
            $userAdmin->email = $request['email'];
            $userAdmin->password = Hash::make($request['password']);
            $userAdmin->cpf = $request['cpf'];
            $userAdmin->phone = removeCaracteres($request['phone']);
            $userAdmin->cep = removeCaracteres($request['cep']);
            $userAdmin->address = $request['address'];
            $userAdmin->number = $request['number'];
            $userAdmin->district = $request['district'];
            $userAdmin->city = $request['city'];
            $userAdmin->state = "RS";

            $userAdmin->save();
        } catch (Throwable $t) {
            return back()->withErrors(['Erro ao cadastrar usuário administrador.']);
        }

        return back()->with('success', 'Usuário administrador cadastrado com sucesso');
    }
}
