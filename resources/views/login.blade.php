<x-guest-layout>
    <div class="mb-6 text-center">
        <p class="text-xs font-semibold uppercase tracking-wider text-cyb-gold">Espace Cybcraft</p>
        <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">Connexion</h1>
        <p class="mt-2 text-sm leading-6 text-neutral-500 dark:text-neutral-400">
            Accédez à votre profil digital, vos contacts et vos cartes NFC.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Adresse email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="vous@entreprise.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <button type="button" id="showPassword" class="text-xs font-semibold text-cyb-gold hover:underline">
                    Afficher
                </button>
            </div>
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Votre mot de passe" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-2 text-sm text-neutral-600 dark:text-neutral-300">
            <input id="remember_me" type="checkbox" class="rounded border-black/20 text-cyb-gold shadow-sm focus:ring-cyb-gold dark:border-white/20 dark:bg-neutral-950" name="remember">
            <span>{{ __('Se souvenir de moi') }}</span>
        </label>

        <x-primary-button class="w-full">
            {{ __('Se connecter') }}
        </x-primary-button>

        <div class="flex items-center justify-center border-t border-black/10 pt-5 text-center text-sm dark:border-white/10">
            <a class="font-medium text-neutral-500 transition hover:text-cyb-gold dark:text-neutral-400" href="https://wa.me/message/MXYG42F32WEZE1">
                {{ __("Contacter l'administrateur") }}
            </a>
        </div>
    </form>

    <script>
        const showPassword = document.getElementById('showPassword');
        const password = document.getElementById('password');

        if (showPassword && password) {
            showPassword.addEventListener('click', () => {
                const visible = password.type === 'text';
                password.type = visible ? 'password' : 'text';
                showPassword.textContent = visible ? 'Afficher' : 'Masquer';
            });
        }
    </script>
</x-guest-layout>
