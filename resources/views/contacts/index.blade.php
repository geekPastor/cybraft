<x-app-layout title="Contacts">
    <div class="space-y-6">
        <x-app-card>
            <div>
                <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Réception</p>
                <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">Contacts reçus</h1>
                <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Les personnes qui ont partagé leurs coordonnées depuis votre profil public.</p>
            </div>
        </x-app-card>

        @if ($contacts->isEmpty())
            <x-empty-state title="Aucun contact" description="Votre liste se remplira quand une personne vous enverra ses coordonnées depuis votre profil." />
        @else
            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($contacts as $contact)
                    <x-app-card>
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="font-semibold text-cyb-ink dark:text-white">{{ $contact->name }}</h2>
                                <p class="mt-1 text-xs text-neutral-500 dark:text-neutral-400">{{ $contact->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            <span class="cyb-pill">Contact</span>
                        </div>

                        <div class="mt-5 space-y-3 text-sm">
                            <a href="mailto:{{ $contact->email }}" class="block rounded-md border border-black/10 p-3 transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10">
                                <span class="block text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Email</span>
                                <span class="mt-1 block break-words">{{ $contact->email }}</span>
                            </a>
                            <a href="tel:{{ $contact->phone }}" class="block rounded-md border border-black/10 p-3 transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10">
                                <span class="block text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Téléphone</span>
                                <span class="mt-1 block">{{ $contact->phone ?: 'Indisponible' }}</span>
                            </a>
                            @if ($contact->adresse)
                                <div class="rounded-md border border-black/10 p-3 dark:border-white/10">
                                    <span class="block text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Adresse</span>
                                    <span class="mt-1 block">{{ $contact->adresse }}</span>
                                </div>
                            @endif
                            @if ($contact->notes)
                                <div class="rounded-md bg-neutral-100 p-3 dark:bg-neutral-950">
                                    <span class="block text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Message</span>
                                    <p class="mt-1 leading-6">{{ $contact->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </x-app-card>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
