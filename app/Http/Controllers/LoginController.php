<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

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
        else{
            return back()->withErrors(["email" => "Email ou mot de passe incorrect"]);
        }
    }
    public function login(){
      return view("login");
  }
}
