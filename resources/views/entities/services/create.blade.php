@extends('base')
@section ('content') 
    <x-form-card>
       <form action="{{ route('entities.services.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <x-input-label for="name">Nom du service</x-input-label>
                <x-text-input type="text" required name="name" id="name" value="{{ old('name') }}" />
            </div>
    
            <x-primary-button>Enregistrer</x-primary-button>
        </form>
    </x-form-card>
@endsection
