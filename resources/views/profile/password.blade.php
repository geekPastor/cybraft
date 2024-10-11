<x-app-layout title="Modification du mot de passe">
    <x-form-card>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('put')
            <h1 class="text-lg font-bold mb-3">Modifier votre mot de passe</h1>
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
            <x-primary-button>Enregistrer</x-primary-button>
        </form>
    
    </x-form-card>
</x-app-layout>