<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityRequest;
use App\Models\Entity;
use App\Models\EntityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntityController extends Controller
{
    public function create()
    {
        $data = [];
        $entity = Auth::user()->entity;
        $data['types'] = $this->getTypes();

        if ($entity) {
            $data['entity'] = $entity;
        }

        return view('entities.create', $data);
    }

    public function store(EntityRequest $request)
    {
        Auth::user()->entity()->create($request->validated());

        return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Entité créée avec succès');
    }

    public function update(EntityRequest $request, Entity $entity)
    {
        Auth::user()->entity()->update($request->validated());

        return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Entité mise à jour avec succès');
    }

    public function createService()
    {
        return view('entities.services.create');
    }

    public function storeService(Request $request)
    {
        Auth::user()->entity->services()->create($request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]));

        return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Service créé avec succès');
    }

    public function getTypes()
    {
        return EntityType::all();
    }
}
