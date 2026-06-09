<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = [];

        if (Auth::user()->role_id == Role::ADMIN) {
            $data['usersCount'] = User::count();
            $data['admins'] = User::where('role_id', Role::ADMIN)->count();
            $data['members'] = User::where('role_id', Role::USER)->count();
            
            $search = $request->input('search');
            $data['users'] = User::query()
                ->with('role')
                ->when($search, function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%')
                          ->orWhere('slug', 'like', '%' . $search . '%');
                    });
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();
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
