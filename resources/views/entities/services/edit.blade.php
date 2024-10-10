@extends('base')
@section ('content') 
    <x-form-card class="w-2/4">
       <form action="{{ route('services.update', $service) }}" method="post">
            @csrf
            @method('put')
            <h1 class="font-bold mb-3">Modifier ce service</h1>
            <div class="mb-3">
                <x-input-label for="name">Nom du service</x-input-label>
                <x-text-input type="text" required name="name" id="name" value="{{ old('name', $service->name) }}" />
            </div>
    
            <x-primary-button>Enregistrer</x-primary-button>
        </form>
    </x-form-card>
@endsection
