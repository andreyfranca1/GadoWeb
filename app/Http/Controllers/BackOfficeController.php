<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class BackOfficeController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('backoffice.index');
    }
}
