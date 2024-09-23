@extends('base')
@section ('content') 
    <div>
       <form action="{{ route('entities.services.store') }}" method="post">
            @csrf
            <div>
                <x-input-label for="name">Name</x-input-label>
                <x-text-input type="text" required name="name" id="name" value="{{ old('name') }}" />
            </div>
    
            <x-primary-button>Enregistrer</x-primary-button>
        </form>
    </div>
@endsection
