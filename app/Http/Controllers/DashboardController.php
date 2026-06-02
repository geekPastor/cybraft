<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];

        if (Auth::user()->role_id == Role::ADMIN) {
            $data['users'] = User::count();
            $data['admins'] = User::where('role_id', Role::ADMIN)->count();
            $data['members'] = User::where('role_id', Role::USER)->count();
            $data['recentUsers'] = User::with('role')->latest()->limit(5)->get();
        } else {
            $user = Auth::user()->load(['entity.services', 'contacts', 'files']);

            $data['services'] = $user->entity ? $user->entity->services->count() : 0;
            $data['contacts'] = $user->contacts->count();
            $data['files'] = $user->files->count();
            $data['profileLink'] = route('profil.compte', $user->getRouteKey());
        }

        return view('dashboard', $data);
    }
}
