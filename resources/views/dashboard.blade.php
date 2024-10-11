<x-app-layout title="Tableau de bord">
    <x-alert>
        <p>Vous êtes connecté!</p>
    </x-alert>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-3">
        @admin
            <x-stat-card title="Utilisateurs" :count="$users"/>
        @else
            <x-stat-card title="Services" :count="$services"/>
        @endadmin
    </div>
</x-app-layout>