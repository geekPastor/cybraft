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
                <x-input-label for="name">Name</x-input-label>
                <x-text-input type="text" required name="name" id="name" value="{{ old('name', $entity?->name) }}" />
            </div>
            <div class="my-2">
                <x-input-label for="description">Description</x-input-label>
                <x-textarea name="description" id="description" class="w-full" required>{{ old('description', $entity?->description) }}</x-textarea>
            </div>
            {{-- address --}}
            <div>
                <x-input-label for="address">Adresse</x-input-label>
                <x-text-input name="address" id="address" required value="{{ old('address', $entity?->address) }}" />
            </div>
            <div class="my-2">
                <x-input-label for="website">Website</x-input-label>
                <x-text-input type="text" name="website" id="website" required value="{{ old('website', $entity?->website) }}" />
            </div>
            <div class="mb-3">
                <x-input-label for="type">Type</x-input-label>
                <x-select-input name="type" id="type">
                    <option value="1" @selected($entity?->type == 1)>Etablissement ou Entreprise</option>
                    <option value="2" @selected($entity?->type == 2)>Université ou Ecole</option>
                </x-select-input>
            </div>
            <div>
                <x-primary-button type="submit">Enregistrer</x-primary-button>
            </div>
        </form>
    </x-form-card>
@endsection
