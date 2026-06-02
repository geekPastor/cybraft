<x-app-layout title="Utilisateurs">
    <div class="space-y-6">
        <x-app-card>
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Administration</p>
                    <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">Utilisateurs</h1>
                    <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Gérez les comptes, rôles et liens de profils publics.</p>
                </div>
                <a href="{{ route('users.create') }}" class="cyb-button-primary w-fit">Ajouter un utilisateur</a>
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
                    @foreach ($users as $user)
                        <tr class="transition hover:bg-cyb-gold/5">
                            <td>{{ $loop->iteration }}</td>
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
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="grid gap-4 lg:hidden">
            @foreach ($users as $user)
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
            @endforeach
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
