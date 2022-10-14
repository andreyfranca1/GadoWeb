<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): Factory|View|Application
    {
        $users = User::all();
        $count = count($users);

        return view('backoffice.users', ['users' => $users, 'count' => $count]);
    }

    public function newUser(): Factory|View|Application
    {
        return view('backoffice.users.new');
    }
}
