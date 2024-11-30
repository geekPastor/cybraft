<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntityRequest;
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\UserFile;
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
        $data = $request->only(['entity_type_id', 'name', 'description', 'address', 'website']);

        $this->storeFiles($request);

        Auth::user()->entity()->create($data);

        return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Entité créée avec succès');
    }

    public function update(EntityRequest $request, Entity $entity)
    {
        $data = $request->only(['entity_type_id', 'name', 'description', 'address', 'website']);

        $this->storeFiles($request);
            
        Auth::user()->entity()->update($data);

        return to_route('profil.compte', Auth::user()->getRouteKey())->with('success', 'Entité mise à jour avec succès');
    }

    public function getTypes()
    {
        return EntityType::all();
    }

    public function storeFiles(EntityRequest $request)
    {
        if ($request->file('files')) {
            foreach ($request->file('files') as $file) {
                $fileExtension = $file->getClientOriginalExtension();
                $fileName = \Str::random(10) . '.' . $fileExtension;
                // Get original file name without extension
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // Store file
                $fileName = $file->storeAs('files', $fileName, 'public');
                // Store file in database
                UserFile::create([
                    'user_id' => Auth::id(),
                    'name' => $originalName,
                    'path' => $fileName,
                ]);
            }
        }
    }
}
