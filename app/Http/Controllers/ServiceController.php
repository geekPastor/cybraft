<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function create()
    {
        return view('entities.services.create');
    }

    public function store(Request $request)
    {
        Auth::user()->entity->services()->create($request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Service créé avec succès');
    }

    public function edit(Service $service)
    {
        return view('entities.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $service->update($request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Service mis à jour avec succès');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Service supprimé avec succès');
    }

}
