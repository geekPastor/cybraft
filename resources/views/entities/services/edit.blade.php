<x-app-layout title="Modifer le service">
    <div class="mx-auto max-w-2xl">
    <x-form-card>
        <form action="{{ route('services.update', $service) }}" method="post" class="space-y-5">
            @csrf
            @method('put')
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Service</p>
                <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">Modifier ce service</h1>
            </div>
            <div>
                <x-input-label for="name">Nom du service</x-input-label>
                <x-text-input type="text" required name="name" id="name" value="{{ old('name', $service->name) }}" />
            </div>
    
            <div class="flex justify-end gap-2 border-t border-black/10 pt-5 dark:border-white/10">
                <x-secondary-link href="{{ route('dashboard') }}">Annuler</x-secondary-link>
                <x-primary-button>Enregistrer</x-primary-button>
            </div>
        </form>
    </x-form-card>
    </div>
</x-app-layout>
