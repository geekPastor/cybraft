<x-app-layout title="Informations de l'utilisateur">
    <x-form-card>
        <h3 class="font-bold">Nom complet : {{ $user->name }}</h3>
        <h3 class="font-bold">Status: {{ $user->role->name }}</h3>
        <h3 class="font-bold">Email : {{ $user->email }}</h3>    
    </x-form-card>
</x-app-layout>
