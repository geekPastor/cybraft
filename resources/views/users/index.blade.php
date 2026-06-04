<x-app-layout title="Utilisateurs">
    <div class="space-y-6">
        <x-app-card>
            <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Administration</p>
                    <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">Utilisateurs</h1>
                    <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Gérez les comptes, rôles et liens de profils publics.</p>
                </div>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2">
                    <form method="GET" action="{{ route('users.index') }}" class="flex items-center gap-2">
                        <div class="relative w-full sm:w-64">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="w-full rounded-md border border-black/10 bg-white/50 py-2 pl-9 pr-3 text-sm text-cyb-ink outline-none placeholder:text-neutral-400 focus:border-cyb-gold dark:border-white/10 dark:bg-neutral-900/50 dark:text-white">
                        </div>
                        @if(request('search'))
                            <a href="{{ route('users.index') }}" class="cyb-button-secondary py-2 text-xs">Réinitialiser</a>
                        @endif
                        <button type="submit" class="cyb-button-primary py-2 text-xs">Rechercher</button>
                    </form>
                    <a href="{{ route('users.create') }}" class="cyb-button-primary text-center">Ajouter un utilisateur</a>
                </div>
            </div>
        </x-app-card>

        <div class="cyb-table-wrapper hidden lg:block">
            <table class="cyb-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom complet</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Mot de passe</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="transition hover:bg-cyb-gold/5">
                            <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                            <td>
                                <div class="font-semibold text-cyb-ink dark:text-white">{{ $user->name }}</div>
                                <div class="text-xs text-neutral-500 dark:text-neutral-400">{{ $user->getRouteKey() }}</div>
                            </td>
                            <td><span class="cyb-pill">{{ $user->role->name }}</span></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <code class="rounded bg-neutral-100 px-2 py-1 text-xs dark:bg-neutral-950">{{ $user->mdp }}</code>
                            </td>
                            <td>
                                <div class="flex justify-end gap-2">
                                    <x-secondary-link href="{{ route('users.show', $user->getRouteKey()) }}">Voir</x-secondary-link>
                                    @if ($user->id !== Auth::id())
                                        <x-secondary-link href="{{ route('users.edit', $user->getRouteKey()) }}">Editer</x-secondary-link>
                                        <x-secondary-button onclick="copyToClipboard('{{ route('profil.compte', $user->getRouteKey()) }}')">Lien</x-secondary-button>
                                        <form action="{{ route('users.destroy', $user->getRouteKey()) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                            @csrf
                                            @method('delete')
                                            <x-danger-button>Supprimer</x-danger-button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-neutral-500 dark:text-neutral-400">Aucun utilisateur trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="grid gap-4 lg:hidden">
            @forelse ($users as $user)
                <x-app-card>
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h2 class="font-semibold text-cyb-ink dark:text-white">{{ $user->name }}</h2>
                            <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">{{ $user->email }}</p>
                        </div>
                        <span class="cyb-pill">{{ $user->role->name }}</span>
                    </div>
                    <div class="mt-4 rounded-md bg-neutral-100 px-3 py-2 text-sm dark:bg-neutral-950">
                        {{ $user->mdp }}
                    </div>
                    <div class="mt-4 flex flex-wrap gap-2">
                        <x-secondary-link href="{{ route('users.show', $user->getRouteKey()) }}">Voir</x-secondary-link>
                        @if ($user->id !== Auth::id())
                            <x-secondary-link href="{{ route('users.edit', $user->getRouteKey()) }}">Editer</x-secondary-link>
                            <x-secondary-button onclick="copyToClipboard('{{ route('profil.compte', $user->getRouteKey()) }}')">Lien</x-secondary-button>
                            <form action="{{ route('users.destroy', $user->getRouteKey()) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                @csrf
                                @method('delete')
                                <x-danger-button>Supprimer</x-danger-button>
                            </form>
                        @endif
                    </div>
                </x-app-card>
            @empty
                <div class="text-center py-8 border border-black/10 rounded-md dark:border-white/10 text-neutral-500 dark:text-neutral-400">Aucun utilisateur trouvé.</div>
            @endforelse
        </div>

        <div>
            {{ $users->links() }}
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => alert('Lien copié dans le presse-papiers'));
        }
    </script>
</x-app-layout>
