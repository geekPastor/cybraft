<x-app-layout title="Modifier les accès de l'utilisateur">
    <x-form-card>
        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('put')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-3 my-3">
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="text"
                                    name="password"
                                    required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <x-primary-button type="submit">
                        {{ __('Enregistrer') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-form-card>
</x-app-layout>