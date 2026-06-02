<x-app-layout title="Ajouter un service de l'entitité">
    <div class="mx-auto max-w-2xl">
        <x-form-card>
        <form action="{{ route('services.store') }}" method="post" class="space-y-5">
             @csrf
             <div>
                 <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Service</p>
                 <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">Ajouter un service</h1>
             </div>
             <div>
                 <x-input-label for="name">Nom du service</x-input-label>
                 <x-text-input type="text" required name="name" id="name" value="{{ old('name') }}" />
             </div>
     
             <div class="flex justify-end gap-2 border-t border-black/10 pt-5 dark:border-white/10">
                <x-secondary-link href="{{ route('dashboard') }}">Annuler</x-secondary-link>
                <x-primary-button>Enregistrer</x-primary-button>
             </div>
         </form>
     </x-form-card>
    </div>
</x-app-layout>
