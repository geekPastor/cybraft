<x-app-layout title="Modifier les accès">
    <div class="mx-auto max-w-3xl space-y-6">
        <x-app-card>
            <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Administration</p>
            <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">{{ $user->name }}</h1>
            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Mettez à jour les accès de connexion de cet utilisateur.</p>
        </x-app-card>

        <x-form-card>
            <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-5">
                @csrf
                @method('put')

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password" :value="__('Nouveau mot de passe')" />
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
