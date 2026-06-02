<x-app-layout title="Informations utilisateur">
    <div class="mx-auto max-w-3xl space-y-6">
        <x-app-card>
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-start">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Utilisateur</p>
                    <h1 class="mt-2 text-3xl font-semibold text-cyb-ink dark:text-white">{{ $user->name }}</h1>
                    <p class="mt-2 text-neutral-500 dark:text-neutral-400">{{ $user->email }}</p>
                </div>
                <span class="cyb-pill">{{ $user->role->name }}</span>
            </div>
        </x-app-card>

        <x-app-card>
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="rounded-md border border-black/10 p-4 dark:border-white/10">
                    <p class="text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Nom complet</p>
                    <p class="mt-2 font-semibold">{{ $user->name }}</p>
                </div>
                <div class="rounded-md border border-black/10 p-4 dark:border-white/10">
                    <p class="text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Role</p>
                    <p class="mt-2 font-semibold">{{ $user->role->name }}</p>
                </div>
                <div class="rounded-md border border-black/10 p-4 dark:border-white/10 sm:col-span-2">
                    <p class="text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Lien public</p>
                    <p class="mt-2 break-all text-sm">{{ route('profil.compte', $user->getRouteKey()) }}</p>
                </div>
            </div>
            <div class="mt-5 flex flex-wrap gap-2">
                <x-secondary-link href="{{ route('users.index') }}">Retour</x-secondary-link>
                <x-secondary-button onclick="navigator.clipboard.writeText('{{ route('profil.compte', $user->getRouteKey()) }}').then(() => alert('Lien copié'))">Copier le lien</x-secondary-button>
            </div>
        </x-app-card>
    </div>
</x-app-layout>
