<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('profile.password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6'
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            Auth::user()->update([
                'password' => Hash::make($request->new_password)
            ]);

            return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Mot de passe modifié');
        } else {
            return back()->withErrors(['password' => 'Mot de passe incorrect']);
        }
    }
}
