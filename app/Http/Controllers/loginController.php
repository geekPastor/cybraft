<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function index(loginRequest $request){
           $data=$request->validated();
           if(Auth::attempt($data)){
              $email=$data['email'];
              $user = User::where('email', $email)->first();
              if($user->role=="admin"){
                $request->session()->regenerate();
                return redirect()->route("profil.admin",$user);
              }
              elseif($user->role="users"){
                $request->session()->regenerate();
                return redirect()->route("profil.compte",$user);
              }
           }
           else{
            return back()->with("error","erreur de connexion");
           }
    }
    public function login(){
      return view("login");
  }
} 
