<x-app-layout title="Ajouter un utilisateur">
    <div class="mx-auto max-w-3xl space-y-6">
        <x-app-card>
            <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Administration</p>
            <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">Nouvel utilisateur</h1>
            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Créez un accès et générez les identifiants à transmettre.</p>
        </x-app-card>

        <x-form-card>
            <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
                @csrf

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <x-input-label for="name" :value="__('Nom complet')" />
                        <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="role_id" :value="__('Role')" />
                        <x-select-input name="role_id" id="role_id" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </x-select-input>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password" :value="__('Mot de passe')" />
                        <x-text-input id="password" type="text" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="flex justify-end gap-2 border-t border-black/10 pt-5 dark:border-white/10">
                    <x-secondary-link href="{{ route('users.index') }}">Annuler</x-secondary-link>
                    <x-primary-button type="submit">{{ __('Enregistrer') }}</x-primary-button>
                </div>
            </form>
        </x-form-card>
    </div>
</x-app-layout>
