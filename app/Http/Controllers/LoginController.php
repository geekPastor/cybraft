<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(loginRequest $request)
    {
        $data=$request->validated();

        if(Auth::attempt($data)){

            $user = Auth::user();
            
            if($user->role_id == Role::ADMIN){
                $request->session()->regenerate();
                return redirect()->route('dashboard');
            }
            elseif($user->role_id == Role::USER){
                $request->session()->regenerate();
                return redirect()->route("profil.compte", $user->getRouteKey());
            }
        }

        $user = User::where('email', $data['email'])->first();

        if (
            $user
            && (
                hash_equals((string) $user->mdp, $data['password'])
                || hash_equals((string) $user->getRawOriginal('password'), $data['password'])
            )
        ) {
            $user->forceFill([
                'password' => Hash::make($data['password']),
            ])->save();

            Auth::login($user);
            $request->session()->regenerate();

            return $user->role_id == Role::ADMIN
                ? redirect()->route('dashboard')
                : redirect()->route("profil.compte", $user->getRouteKey());
        }

        return back()->withErrors(["email" => "Email ou mot de passe incorrect"])->onlyInput('email');
    }
    public function login(){
      return view("login");
  }
}
