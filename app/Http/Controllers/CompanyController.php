<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index(): Factory|View|Application
    {
        $companies = Company::all();
        $count = count($companies);

        return view('backoffice.companies.index', ['companies' => $companies, 'count' => $count]);
    }


    public function newCompany(Request $request)
    {
        $rules = [
            'type' => ['required'],
            'companyName' => ['required'],
            'doc_number' => ['required'],
            'cellphone' => ['required'],
            'cep' => ['required'],
            'address' => ['required'],
            'number' => ['required'],
            'district' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'born_date' => ['required'],
            'nameUser' => ['required'],
            'emailUser' => ['required', 'email'],
            'cpfUser' => ['required'],
            'userPhone' => ['required'],
            'passUser' => ['required'],
            'passUserConfirm' => ['required']
        ];

        $errorMessage = [
            'type.required' => 'Selecione o tipo da empresa.',
            'companyName.required' => 'Informe o nome da empresa.',
            'doc_number.required' => 'Informe o CPF/CNPJ da empresa.',
            'cellphone.required' => 'Informe o celular da empresa.',
            'cep.required' => 'Cep não informado.',
            'address.required' => 'Informe a rua da empresa.',
            'number.required' => 'Informe o número do endereço da empresa.',
            'district.required' => 'Informe o bairro do endereço da empresa.',
            'city.required' => 'Informe a cidade da empresa.',
            'state.required' => 'Informe o estado da empresa.',
            'born_date.required' => 'Informe a data de abertura da empresa.',
            'nameUser.required' => 'Informe o nome do usuário.',
            'emailUser.required' => 'Informe o email do usuário.',
            'emailUser.email' => 'Informe um email válido para usuário.',
            'cpfUser.required' => 'Informe o CPF do usuário.',
            'userPhone.required' => 'Informe o telefone do usuário.',
            'passUser.required' => 'O campo senha é obrigatório',
            'passUserConfirm.required' => 'Necessário informar a confirmação da senha'
        ];

        $request->validate($rules, $errorMessage);

        $company = new Company();

        $company->type = $request['tipoCadastro'];
        $company->name = $request['companyName'];
        $company->doc_number = $request['doc_number'];
        $company->doc_number2 = !empty($request['doc_number2']) ? $request['doc_number2'] : "ISENTO";
        $company->email = $request['email'];
        $company->phone =  $request['phone'];
        $company->cellphone =  $request['cellphone'];
        $company->cep =  $request['cep'];
        $company->address =  $request['address'];
        $company->number =  $request['number'];
        $company->district =  $request['district'];
        $company->city =  $request['city'];
        $company->state =  $request['state'];
        $company->born_date = $request['born_date'];

        $company->save();

        $user = new User();

        $user->company_id = $company->id;
        $user->name = $request['nameUser'];
        $user->email = $request['emailUser'];
        $user->cpf = $request['cpfUser'];
        $user->phone = $request['userPhone'];
        $user->password= Hash::make($request['passUser']);

        $user->save();
    }
}
