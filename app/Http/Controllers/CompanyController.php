<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(): Factory|View|Application
    {
        $companies = Company::all();
        $count = count($companies);

        return view('backoffice.companies.index', ['companies' => $companies, 'count' => $count]);
    }

    public function newCompany()
    {
        return view('backoffice.companies.new');
    }
}
