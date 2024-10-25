<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        abort_if(Auth::user()->role_id != Role::ADMIN, 404);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['mdp'] = $data['password'];
        $data['password'] = Hash::make($data['password']);
        $data['slug'] = \Str::slug($data['name']);
        
        User::create($data);

        return to_route('users.index')->with('success', 'Utilisateur enregistrée avec succèss');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        // Check email
        if ($user->email != $data['email']) {
            $request->validate([
                'email' => 'unique:users',
            ]);
        }

        $user->update($data);

        return to_route('users.index')->with('success', 'Utilisateur modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return to_route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
