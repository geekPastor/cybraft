@extends('base')

@section ('content') 
    @isset($entity)
        @php
            $route = route('entities.update', $entity);
            $method = 'PUT';
        @endphp
    @else
        @php
            $route = route('entities.store');
            $method = 'POST';
            $entity = null;
        @endphp
    @endisset
    <x-form-card class="w-1/3">
        <form action="{{ $route }}" method="POST">
            @csrf
            @method($method)
            <div>
                <x-input-label for="name">Nom de la société</x-input-label>
                <x-text-input type="text" required name="name" id="name" value="{{ old('name', $entity?->name) }}" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="my-2">
                <x-input-label for="description">Description</x-input-label>
                <x-textarea name="description" id="description" class="w-full" required>{{ old('description', $entity?->description) }}</x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            {{-- address --}}
            <div>
                <x-input-label for="address">Adresse</x-input-label>
                <x-text-input name="address" id="address" required value="{{ old('address', $entity?->address) }}" />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
            <div class="my-2">
                <x-input-label for="website">Site web</x-input-label>
                <x-text-input type="text" name="website" id="website" required value="{{ old('website', $entity?->website) }}" placeholder="ex : https://google.com"/>
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>
            <div class="mb-3">
                <x-input-label for="type">Type</x-input-label>
                <x-select-input name="entity_type_id" id="type">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @selected($entity?->type->id == $type->id)>{{ $type->name }}</option>
                    @endforeach
                </x-select-input>
                <x-input-error :messages="$errors->get('entity_type_id')" class="mt-2" />
            </div>
            <div>
                <x-primary-button type="submit">Enregistrer</x-primary-button>
            </div>
        </form>
    </x-form-card>
@endsection
