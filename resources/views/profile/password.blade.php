<x-app-layout title="Modification du mot de passe">
    <div class="mx-auto max-w-2xl">
    <x-form-card>
        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('put')
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Sécurité</p>
                <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">Modifier votre mot de passe</h1>
            </div>
            <div>
                <x-input-label for="password" :value="__('Mot de passe actuel')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="my-3">
                <x-input-label for="new_password" :value="__('Nouveau mot de passe')" />
                <x-text-input id="new_password" class="block mt-1 w-full"
                                type="password"
                                name="new_password"
                                required/>
                <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
            </div>
            <div class="flex justify-end border-t border-black/10 pt-5 dark:border-white/10">
                <x-primary-button>Enregistrer</x-primary-button>
            </div>
        </form>
    
    </x-form-card>
    </div>
</x-app-layout>
