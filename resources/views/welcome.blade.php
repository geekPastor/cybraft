<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->name }}</title>
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <script defer src="{{ asset('custom.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite('resources/css/app.css')
</head>
<body class="font-sans">
    @php
        $profil = $user->profil;
        $entity = $user->entity;
        $reseau = $profil?->reseau;
        $isOwner = Auth::id() === $user->id;
        $phone = $profil?->number ?? $profil?->number2;
        $socials = [
            ['label' => 'Facebook', 'key' => 'facebook', 'url' => $reseau?->facebook, 'icon' => 'fab fa-facebook-f'],
            ['label' => 'X', 'key' => 'twitter', 'url' => $reseau?->twitter, 'icon' => 'fab fa-x-twitter'],
            ['label' => 'Threads', 'key' => 'threads', 'url' => $reseau?->theads, 'icon' => 'fab fa-threads'],
            ['label' => 'Instagram', 'key' => 'instagram', 'url' => $reseau?->instagram, 'icon' => 'fab fa-instagram'],
            ['label' => 'LinkedIn', 'key' => 'linkedin', 'url' => $reseau?->linkedin, 'icon' => 'fab fa-linkedin-in'],
            ['label' => 'Telegram', 'key' => 'telegram', 'url' => $reseau?->telegram, 'icon' => 'fab fa-telegram'],
            ['label' => 'WhatsApp', 'key' => 'whatsapp', 'url' => $reseau?->whatsapp, 'icon' => 'fab fa-whatsapp'],
            ['label' => 'TikTok', 'key' => 'tiktok', 'url' => $reseau?->tiktok, 'icon' => 'fab fa-tiktok'],
        ];
        
        // Ajouter le réseau personnalisé s'il existe
        if (!empty($reseau?->custom_url) && !empty($reseau?->custom_name)) {
            $socials[] = ['label' => $reseau->custom_name, 'key' => 'custom', 'url' => $reseau->custom_url, 'icon' => 'fas fa-link'];
        }
        
        $visibleSocials = collect($socials)->filter(fn ($social) => !empty($social['url']) && $social['url'] !== 'https://');
    @endphp

    <div class="min-h-screen bg-[radial-gradient(circle_at_top_right,rgba(200,148,47,0.18),transparent_32%)]">
        <header class="sticky top-0 z-40 border-b border-black/10 bg-cyb-paper/85 backdrop-blur dark:border-white/10 dark:bg-neutral-950/85">
            <div class="cyb-container flex h-16 items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('LOGOS/Original Couleur.svg') }}" class="h-10 w-auto dark:hidden" alt="{{ config('app.name', 'Cybcraft') }}">
                    <img src="{{ asset('LOGOS/Couleur Blanc.jpg') }}" class="hidden h-10 w-auto rounded-sm dark:block" alt="{{ config('app.name', 'Cybcraft') }}">
                </a>
                <div class="flex items-center gap-2">
                    <button type="button" data-theme-toggle class="grid size-10 place-items-center rounded-full border border-black/10 bg-white/80 text-cyb-ink shadow-sm backdrop-blur transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10 dark:bg-neutral-900/80 dark:text-neutral-100">
                        <span class="sr-only">Changer le mode d'affichage</span>
                        <svg class="size-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 15.25A9 9 0 0 1 8.75 2.25 7.5 7.5 0 1 0 21.75 15.25Z" />
                        </svg>
                        <svg class="hidden size-5 dark:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.36-6.36-1.59 1.59M7.23 16.77l-1.59 1.59m12.72 0-1.59-1.59M7.23 7.23 5.64 5.64M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                        </svg>
                    </button>
                    <button id="menuIcon" type="button" class="rounded-full border border-black/10 bg-white/80 p-2 text-cyb-ink shadow-sm transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10 dark:bg-neutral-900/80 dark:text-neutral-100">
                        <span class="sr-only">Menu</span>
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M10 17h10" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <div id="sideMenu" class="fixed right-4 top-20 z-50 hidden w-[min(22rem,calc(100vw-2rem))] rounded-lg border border-black/10 bg-white p-5 shadow-soft dark:border-white/10 dark:bg-neutral-900">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold">CybCard</h2>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400">Scannez ou gérez ce profil.</p>
                </div>
                <button id="closeMenu" type="button" class="text-neutral-500 hover:text-cyb-gold">Fermer</button>
            </div>
            <div class="mx-auto mt-5 flex size-40 items-center justify-center overflow-hidden rounded-md border border-black/10 bg-white p-2 dark:border-white/10">
                <div class="size-full [&>svg]:size-full flex items-center justify-center">
                    {!! $qrCode !!}
                </div>
            </div>
            <div class="mt-5 grid gap-2">
                @auth
                    @if ($isOwner)
                        <a class="cyb-button-primary w-full" href="{{ route('dashboard') }}">Accéder au dashboard</a>
                        <a class="cyb-button-secondary w-full" href="{{ route('profil.update', $user->getRouteKey()) }}">Modifier mes informations</a>
                        <a class="cyb-button-secondary w-full" href="{{ route('password.edit') }}">Modifier le mot de passe</a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="cyb-button-secondary w-full">Se déconnecter</button>
                        </form>
                    @else
                        <a class="cyb-button-secondary w-full" href="{{ route('login') }}">Se connecter</a>
                        <a class="cyb-button-primary w-full" href="https://wa.me/message/MXYG42F32WEZE1">Obtenir ma carte</a>
                    @endif
                @else
                    <a class="cyb-button-secondary w-full" href="{{ route('login') }}">Se connecter</a>
                    <a class="cyb-button-primary w-full" href="https://wa.me/message/MXYG42F32WEZE1">Obtenir ma carte</a>
                @endauth
            </div>
        </div>

        <main class="cyb-container py-8 sm:py-12">
            <section class="overflow-hidden rounded-lg border border-black/10 bg-white shadow-soft dark:border-white/10 dark:bg-neutral-900">
                <div class="h-36 bg-[linear-gradient(135deg,#11100d,#7b4b1d_52%,#c8942f)] sm:h-44"></div>
                <div class="px-5 pb-8 sm:px-8">
                    <div class="-mt-16 flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                        <button id="editBtn" type="button" class="w-fit rounded-full">
                            <img src="{{ isset($user->picture->picture) ? $user->getImageUrl() : asset('black.jpeg') }}" alt="Photo de {{ $user->name }}" class="size-32 rounded-full border-4 border-white object-cover shadow-soft dark:border-neutral-900">
                        </button>
                        <div class="flex flex-wrap gap-2">
                            @if ($user->id != Auth::id())
                                <form id="vcard" action="{{ route('vcard', $user->getRouteKey()) }}" method="post">
                                    @csrf
                                </form>
                                <button form="vcard" type="submit" class="cyb-button-primary">Enregistrer contact</button>
                                <button onclick="togglePopup()" type="button" class="cyb-button-secondary">Envoyer mon contact</button>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6 grid gap-8 lg:grid-cols-[0.95fr_1.4fr]">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">{{ $profil?->profession ?? 'Profil professionnel' }}</p>
                            <h1 class="mt-2 text-3xl font-semibold text-cyb-ink dark:text-white sm:text-5xl">{{ $user->name }}</h1>
                            <p class="mt-4 max-w-xl leading-7 text-neutral-600 dark:text-neutral-300">
                                {{ $profil?->bio ?: "Aucune biographie n'a encore été renseignée." }}
                            </p>

                            @if ($visibleSocials->isNotEmpty())
                                <div class="mt-6 flex flex-wrap gap-3">
                                    @foreach ($visibleSocials as $social)
                                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" title="{{ $social['label'] }}" class="inline-flex items-center justify-center size-12 rounded-full border border-black/10 bg-white/50 text-cyb-ink shadow-sm transition hover:border-cyb-gold hover:bg-cyb-gold/10 hover:text-cyb-gold dark:border-white/10 dark:bg-neutral-900/50 dark:text-neutral-100 dark:hover:bg-cyb-gold/20 dark:hover:text-cyb-gold">
                                            <i class="{{ $social['icon'] }} text-lg"></i>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="grid gap-3 sm:grid-cols-2">
                            <a class="cyb-card" href="mailto:{{ $user->email }}">
                                <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Email professionnel</p>
                                <p class="mt-2 break-words font-medium">{{ $user->email }}</p>
                            </a>
                            @if ($profil?->private_email)
                                <a class="cyb-card" href="mailto:{{ $profil->private_email }}">
                                    <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Email privé</p>
                                    <p class="mt-2 break-words font-medium">{{ $profil->private_email }}</p>
                                </a>
                            @endif
                            <a class="cyb-card" href="{{ $phone ? 'tel:'.$phone : '#' }}">
                                <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Téléphone</p>
                                <p class="mt-2 font-medium">
                                    @if ($profil?->number && $profil?->number2)
                                        {{ $profil->number }} / {{ $profil->number2 }}
                                    @else
                                        {{ $phone ?? 'Indisponible' }}
                                    @endif
                                </p>
                            </a>
                            <div class="cyb-card">
                                <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">{{ $entity ? 'Entité' : 'Société' }}</p>
                                <p class="mt-2 font-medium">{{ $entity->name ?? 'Indisponible' }}</p>
                                @if ($isOwner)
                                    <x-link href="{{ route('entities.create') }}">Editer</x-link>
                                @endif
                            </div>
                            <div class="cyb-card sm:col-span-2">
                                <p class="text-xs font-semibold uppercase tracking-wider text-neutral-500 dark:text-neutral-400">Adresse</p>
                                <p class="mt-2 font-medium">{{ $entity->address ?? 'Indisponible' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @if ($errors->any())
                <div class="mt-6 rounded-md border border-red-500/30 bg-red-500/10 p-4 text-red-700 dark:text-red-300">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($entity)
                <section class="mt-6 grid gap-6 lg:grid-cols-[0.8fr_1.2fr]">
                    <article class="cyb-card">
                        <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Entité</p>
                        <h2 class="mt-2 text-2xl font-semibold">{{ $entity->name }}</h2>
                        <p class="mt-3 leading-7 text-neutral-600 dark:text-neutral-300">{{ $entity->description ?? 'Aucune description disponible.' }}</p>
                        @if ($entity->website)
                            <a href="{{ $entity->website }}" class="cyb-button-secondary mt-5">Visiter le site</a>
                        @endif
                    </article>

                    @if (($entity->type->id ?? null) == 1 || ($entity->type->id ?? null) == 2)
                        <article class="cyb-card">
                            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
                                <div>
                                    <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Services</p>
                                    <h2 class="mt-2 text-2xl font-semibold">Ce que je propose</h2>
                                </div>
                                @if ($isOwner)
                                    <a href="{{ route('services.create') }}" class="cyb-button-primary w-fit">Ajouter</a>
                                @endif
                            </div>

                            <div class="mt-5 grid gap-3 sm:grid-cols-2">
                                @forelse ($entity->services as $service)
                                    <div class="rounded-md border border-black/10 p-4 dark:border-white/10">
                                        <div class="flex items-start justify-between gap-3">
                                            <p class="font-semibold">{{ $service->name }}</p>
                                            @if ($isOwner)
                                                <form action="{{ route('services.destroy', $service) }}" method="post" id="deleteService_{{ $loop->iteration }}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @endif
                                        </div>
                                        @if ($isOwner)
                                            <div class="mt-3 flex gap-3 text-sm">
                                                <x-link href="{{ route('services.edit', $service) }}">Editer</x-link>
                                                <button type="submit" class="font-semibold text-red-600 hover:underline" form="deleteService_{{ $loop->iteration }}">Supprimer</button>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-neutral-600 dark:text-neutral-300">Aucun service disponible.</p>
                                @endforelse
                            </div>
                        </article>
                    @endif
                </section>
            @endif

            @if ($user->files->count() != 0)
                <section class="mt-6 cyb-card">
                    <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Pièces jointes</p>
                    <h2 class="mt-2 text-2xl font-semibold">Documents partagés</h2>
                    <div class="mt-5 grid gap-3 sm:grid-cols-2">
                        @foreach ($user->files as $file)
                            <div class="rounded-md border border-black/10 p-4 dark:border-white/10">
                                <p class="font-semibold">{{ $file->name }}</p>
                                <a href="{{ asset($file->getUrl()) }}" class="mt-2 inline-flex font-semibold text-cyb-gold hover:underline">Télécharger</a>
                                @if ($isOwner)
                                    <form action="{{ route('files.destroy', $file) }}" method="post" class="mt-2" id="deleteFile_{{ $loop->iteration }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-semibold text-red-600 hover:underline">Supprimer</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif
        </main>
    </div>

    @if ($isOwner)
        <div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4">
            <div class="w-full max-w-sm rounded-lg bg-white p-6 shadow-soft dark:bg-neutral-900">
                <h2 class="text-lg font-semibold">Modifier la photo de profil</h2>
                <form id="profileForm" action="{{ route('uppload', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <input type="file" name="picture" accept="image/*" class="cyb-input">
                    <div class="mt-5 flex justify-end gap-2">
                        <button type="button" id="closeModal" class="cyb-button-secondary">Annuler</button>
                        <button type="submit" class="cyb-button-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4" id="popupForm">
        <div class="w-full max-w-lg rounded-lg bg-white p-6 shadow-soft dark:bg-neutral-900">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold">Envoyer mon contact à {{ $user->name }}</h2>
                    <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">Vos informations lui seront transmises par email.</p>
                </div>
                <button type="button" class="text-neutral-500 hover:text-cyb-gold" onclick="togglePopup()">Fermer</button>
            </div>

            <form action="{{ route('profil.mail', $user->getRouteKey()) }}" method="POST" class="mt-5 grid gap-4">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}" required>
                <input type="hidden" name="toMail" value="{{ $user->email }}">
                <div>
                    <x-input-label for="name">Nom complet</x-input-label>
                    <x-text-input type="text" id="name" name="name" placeholder="Nom complet" />
                </div>
                <div>
                    <x-input-label for="email">Email</x-input-label>
                    <x-text-input type="email" id="email" name="email" placeholder="Adresse email" />
                </div>
                <div>
                    <x-input-label for="phone">Numéro de téléphone</x-input-label>
                    <x-text-input type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" />
                </div>
                <div>
                    <x-input-label for="address">Adresse</x-input-label>
                    <x-text-input type="text" id="address" name="adresse" placeholder="Adresse, code postal, ville" />
                </div>
                <div>
                    <x-input-label for="notes">Notes</x-input-label>
                    <x-textarea id="notes" name="notes" placeholder="Ajouter une note"></x-textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" class="cyb-button-secondary" onclick="togglePopup()">Annuler</button>
                    <button type="submit" class="cyb-button-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const menuIcon = document.getElementById('menuIcon');
        const menu = document.getElementById('sideMenu');
        const closeMenu = document.getElementById('closeMenu');

        if (menuIcon && menu) {
            menuIcon.addEventListener('click', () => menu.classList.toggle('hidden'));
        }

        if (closeMenu && menu) {
            closeMenu.addEventListener('click', () => menu.classList.add('hidden'));
        }

        function togglePopup() {
            const popupForm = document.getElementById('popupForm');
            popupForm.classList.toggle('hidden');
            popupForm.classList.toggle('flex');
        }

        const closeModal = document.getElementById('closeModal');
        const editBtn = document.getElementById('editBtn');
        const modal = document.getElementById('modal');

        if (closeModal && modal) {
            closeModal.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        }

        if (editBtn && modal) {
            editBtn.addEventListener('click', function() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        }
    </script>
</body>
</html>
