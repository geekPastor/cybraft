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
                <x-stat-card title="Utilisateurs" :count="$users" />
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
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-cyb-ink dark:text-white">Derniers utilisateurs</h2>
                        <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Vue rapide des comptes récemment créés.</p>
                    </div>
                    <a href="{{ route('users.index') }}" class="text-sm font-semibold text-cyb-gold hover:underline">Tout voir</a>
                </div>

                <div class="mt-5 grid gap-3">
                    @forelse ($recentUsers as $recentUser)
                        <div class="flex items-center justify-between gap-4 rounded-md border border-black/10 p-4 dark:border-white/10">
                            <div>
                                <p class="font-semibold text-cyb-ink dark:text-white">{{ $recentUser->name }}</p>
                                <p class="text-sm text-neutral-500 dark:text-neutral-400">{{ $recentUser->email }}</p>
                            </div>
                            <span class="cyb-pill">{{ $recentUser->role->name }}</span>
                        </div>
                    @empty
                        <x-empty-state title="Aucun utilisateur" description="Les utilisateurs créés apparaîtront ici." />
                    @endforelse
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

            <script>
                function copyToClipboard(text) {
                    navigator.clipboard.writeText(text).then(() => alert('Lien copié dans le presse-papiers'));
                }
            </script>
        @endadmin
    </div>
</x-app-layout>
