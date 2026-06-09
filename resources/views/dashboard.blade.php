<x-app-layout title="Tableau de bord">
    @php($user = Auth::user())

    <div class="space-y-6">
        <x-app-card class="overflow-hidden">
            <div class="flex flex-col justify-between gap-6 lg:flex-row lg:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Bienvenue</p>
                    <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white sm:text-3xl">
                        {{ $user->name }}
                    </h1>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-neutral-500 dark:text-neutral-400">
                        @admin
                            Gérez les utilisateurs, leurs accès et les profils publics depuis un espace plus lisible.
                        @else
                            Gardez votre profil Cybcraft à jour et suivez les contacts reçus depuis votre carte.
                        @endadmin
                    </p>
                </div>
                <div class="flex flex-wrap gap-2">
                    @admin
                        <a href="{{ route('users.create') }}" class="cyb-button-primary">Ajouter un utilisateur</a>
                        <a href="{{ route('users.index') }}" class="cyb-button-secondary">Voir les utilisateurs</a>
                    @else
                        <a href="{{ route('profil.compte', $user->getRouteKey()) }}" class="cyb-button-primary">Voir mon profil</a>
                        <a href="{{ route('profil.update', $user->getRouteKey()) }}" class="cyb-button-secondary">Modifier</a>
                    @endadmin
                </div>
            </div>
        </x-app-card>

        <div class="grid gap-4 md:grid-cols-3">
            @admin
                <x-stat-card title="Utilisateurs" :count="$usersCount" />
                <x-stat-card title="Administrateurs" :count="$admins" />
                <x-stat-card title="Profils membres" :count="$members" />
            @else
                <x-stat-card title="Services" :count="$services" />
                <x-stat-card title="Contacts reçus" :count="$contacts" />
                <x-stat-card title="Fichiers" :count="$files" />
            @endadmin
        </div>

        @admin
            <x-app-card>
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-cyb-ink dark:text-white">Gestion des utilisateurs</h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Recherchez des utilisateurs, gérez les comptes, rôles et liens de profils publics.</p>
                    </div>
                    <form method="GET" action="{{ route('dashboard') }}" class="flex w-full max-w-md items-center gap-2">
                        <div class="relative w-full">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-neutral-400">
                                <svg class="size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher un utilisateur..." class="w-full rounded-md border border-black/10 bg-white/50 py-2 pl-9 pr-3 text-sm text-cyb-ink outline-none placeholder:text-neutral-400 focus:border-cyb-gold dark:border-white/10 dark:bg-neutral-900/50 dark:text-white">
                        </div>
                        @if(request('search'))
                            <a href="{{ route('dashboard') }}" class="cyb-button-secondary py-2 text-xs">Réinitialiser</a>
                        @endif
                        <button type="submit" class="cyb-button-primary py-2 text-xs">Rechercher</button>
                    </form>
                </div>

                <div class="mt-6 cyb-table-wrapper hidden lg:block">
                    <table class="cyb-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom complet</th>
                                <th>Rôle</th>
                                <th>Email</th>
                                <th>Mot de passe</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $userItem)
                                <tr class="transition hover:bg-cyb-gold/5">
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>
                                        <div class="font-semibold text-cyb-ink dark:text-white">{{ $userItem->name }}</div>
                                        <div class="text-xs text-neutral-500 dark:text-neutral-400">{{ $userItem->getRouteKey() }}</div>
                                    </td>
                                    <td><span class="cyb-pill">{{ $userItem->role->name }}</span></td>
                                    <td>{{ $userItem->email }}</td>
                                    <td>
                                        <code class="rounded bg-neutral-100 px-2 py-1 text-xs dark:bg-neutral-950">{{ $userItem->mdp }}</code>
                                    </td>
                                    <td>
                                        <div class="flex justify-end gap-2">
                                            <x-secondary-link href="{{ route('users.show', $userItem->getRouteKey()) }}">Voir</x-secondary-link>
                                            @if ($userItem->id !== Auth::id())
                                                <x-secondary-link href="{{ route('users.edit', $userItem->getRouteKey()) }}">Éditer</x-secondary-link>
                                                <x-secondary-button onclick="copyToClipboard('{{ route('profil.compte', $userItem->getRouteKey()) }}')">Lien</x-secondary-button>
                                                <form action="{{ route('users.destroy', $userItem->getRouteKey()) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
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
                                    <td colspan="6" class="text-center py-8">
                                        <p class="text-neutral-500 dark:text-neutral-400">Aucun utilisateur trouvé.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 grid gap-4 lg:hidden">
                    @forelse ($users as $userItem)
                        <div class="rounded-lg border border-black/10 bg-white/50 p-4 dark:border-white/10 dark:bg-neutral-900/50">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="font-semibold text-cyb-ink dark:text-white">{{ $userItem->name }}</h2>
                                    <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">{{ $userItem->email }}</p>
                                </div>
                                <span class="cyb-pill">{{ $userItem->role->name }}</span>
                            </div>
                            <div class="mt-4 rounded-md bg-neutral-100 px-3 py-2 text-sm dark:bg-neutral-950">
                                {{ $userItem->mdp }}
                            </div>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <x-secondary-link href="{{ route('users.show', $userItem->getRouteKey()) }}">Voir</x-secondary-link>
                                @if ($userItem->id !== Auth::id())
                                    <x-secondary-link href="{{ route('users.edit', $userItem->getRouteKey()) }}">Éditer</x-secondary-link>
                                    <x-secondary-button onclick="copyToClipboard('{{ route('profil.compte', $userItem->getRouteKey()) }}')">Lien</x-secondary-button>
                                    <form action="{{ route('users.destroy', $userItem->getRouteKey()) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        @csrf
                                        @method('delete')
                                        <x-danger-button>Supprimer</x-danger-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 border border-black/10 rounded-md dark:border-white/10">
                            <p class="text-neutral-500 dark:text-neutral-400">Aucun utilisateur trouvé.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </x-app-card>
        @else
            <div class="grid gap-6 lg:grid-cols-[1fr_0.8fr]">
                <x-app-card>
                    <h2 class="text-lg font-semibold text-cyb-ink dark:text-white">Actions rapides</h2>
                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        <a href="{{ route('profil.qr', $user->getRouteKey()) }}" class="rounded-md border border-black/10 p-4 transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10">
                            <span class="text-sm font-semibold">QR Code</span>
                            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Partager votre profil sans NFC.</p>
                        </a>
                        <a href="{{ route('contacts.index') }}" class="rounded-md border border-black/10 p-4 transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10">
                            <span class="text-sm font-semibold">Contacts</span>
                            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Consulter les personnes reçues.</p>
                        </a>
                        <a href="{{ route('entities.create') }}" class="rounded-md border border-black/10 p-4 transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10">
                            <span class="text-sm font-semibold">Entité</span>
                            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Entreprise, adresse et services.</p>
                        </a>
                        <button type="button" onclick="copyToClipboard('{{ $profileLink }}')" class="rounded-md border border-black/10 p-4 text-left transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10">
                            <span class="text-sm font-semibold">Copier le lien</span>
                            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Partager rapidement votre profil.</p>
                        </button>
                    </div>
                </x-app-card>

                <x-app-card>
                    <h2 class="text-lg font-semibold text-cyb-ink dark:text-white">Profil public</h2>
                    <p class="mt-2 text-sm leading-6 text-neutral-500 dark:text-neutral-400">Votre lien public est prêt à être partagé sur carte NFC, QR code, email ou WhatsApp.</p>
                    <div class="mt-5 rounded-md border border-black/10 bg-white/60 p-3 text-sm break-all dark:border-white/10 dark:bg-white/5">
                        {{ $profileLink }}
                    </div>
                </x-app-card>
            </div>
        @endadmin

        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(() => alert('Lien copié dans le presse-papiers'));
            }
        </script>
    </div>
</x-app-layout>
