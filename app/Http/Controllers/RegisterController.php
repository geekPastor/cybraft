<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\registerRequest;
class RegisterController extends Controller
{
    public function index(registerRequest $request)
    {
         $data=$request->validated();
         $password=Hash::make($data['password']);
         $data['role']="users";
         User::create($data);
         return redirect("/register");
    }
    public function show()
    {
       return view("admin.show");
    }
}
