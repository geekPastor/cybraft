<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];

        if (Auth::user()->role_id == Role::ADMIN) {
            $data['users'] = User::count();
        } else {
            $data['services'] = Auth::user()->entity ? Auth::user()->entity->services->count() : 0;
        }

        return view('dashboard', $data);
    }
}
