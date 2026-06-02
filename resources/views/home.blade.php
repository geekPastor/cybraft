<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cybcraft') }} | Cartes de visite NFC</title>
    <meta name="description" content="Cybcraft transforme votre carte de visite en profil digital NFC, QR code et contact partageable en un geste.">
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <script defer src="{{ asset('custom.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans">
    <div class="min-h-screen overflow-hidden">
        <header class="fixed inset-x-0 top-0 z-50 border-b border-black/10 bg-cyb-paper/85 backdrop-blur dark:border-white/10 dark:bg-neutral-950/85">
            <div class="cyb-container flex h-16 items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('LOGOS/Original Couleur.svg') }}" class="h-11 w-auto dark:hidden" alt="{{ config('app.name', 'Cybcraft') }}">
                    <img src="{{ asset('LOGOS/Couleur Blanc.jpg') }}" class="hidden h-11 w-auto rounded-sm dark:block" alt="{{ config('app.name', 'Cybcraft') }}">
                </a>

                <nav class="hidden items-center gap-8 text-sm font-medium text-neutral-600 dark:text-neutral-300 md:flex">
                    <a href="#solution" class="transition hover:text-cyb-gold">Solution</a>
                    <a href="#cartes" class="transition hover:text-cyb-gold">Cartes</a>
                    <a href="#profil" class="transition hover:text-cyb-gold">Profil</a>
                    <a href="#contact" class="transition hover:text-cyb-gold">Contact</a>
                </nav>

                <div class="flex items-center gap-2">
                    <button type="button" data-theme-toggle class="grid size-10 place-items-center rounded-full border border-black/10 bg-white/70 text-cyb-ink transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10 dark:bg-white/5 dark:text-neutral-100">
                        <span class="sr-only">Changer le mode d'affichage</span>
                        <svg class="size-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 15.25A9 9 0 0 1 8.75 2.25 7.5 7.5 0 1 0 21.75 15.25Z" />
                        </svg>
                        <svg class="hidden size-5 dark:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.36-6.36-1.59 1.59M7.23 16.77l-1.59 1.59m12.72 0-1.59-1.59M7.23 7.23 5.64 5.64M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                        </svg>
                    </button>
                    <a href="{{ route('login') }}" class="hidden rounded-md px-4 py-2 text-sm font-semibold text-cyb-ink transition hover:text-cyb-gold dark:text-neutral-100 sm:inline-flex">Connexion</a>
                    <a href="https://wa.me/message/MXYG42F32WEZE1" class="hidden px-4 py-2 sm:inline-flex cyb-button-primary">Commander</a>
                    <button type="button" data-mobile-menu-toggle="home-mobile-menu" aria-expanded="false" class="inline-flex rounded-full border border-black/10 bg-white/70 p-2 text-cyb-ink transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10 dark:bg-white/5 dark:text-neutral-100 md:hidden">
                        <span class="sr-only">Ouvrir le menu</span>
                        <svg class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 12h16M10 17h10" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="home-mobile-menu" class="hidden border-t border-black/10 bg-cyb-paper/95 px-4 py-4 shadow-soft dark:border-white/10 dark:bg-neutral-950/95 md:hidden">
                <nav class="mx-auto grid max-w-7xl gap-2 text-sm font-semibold text-neutral-700 dark:text-neutral-200">
                    <a data-mobile-menu-close="home-mobile-menu" href="#solution" class="rounded-md px-3 py-3 transition hover:bg-cyb-gold/10 hover:text-cyb-gold">Solution</a>
                    <a data-mobile-menu-close="home-mobile-menu" href="#cartes" class="rounded-md px-3 py-3 transition hover:bg-cyb-gold/10 hover:text-cyb-gold">Cartes</a>
                    <a data-mobile-menu-close="home-mobile-menu" href="#profil" class="rounded-md px-3 py-3 transition hover:bg-cyb-gold/10 hover:text-cyb-gold">Profil</a>
                    <a data-mobile-menu-close="home-mobile-menu" href="#contact" class="rounded-md px-3 py-3 transition hover:bg-cyb-gold/10 hover:text-cyb-gold">Contact</a>
                    <div class="mt-2 grid grid-cols-2 gap-2">
                        <a href="{{ route('login') }}" class="cyb-button-secondary px-4 py-2">Connexion</a>
                        <a href="https://wa.me/message/MXYG42F32WEZE1" class="cyb-button-primary px-4 py-2">Commander</a>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <section class="relative pt-28 sm:pt-32">
                <div class="absolute inset-x-0 top-0 -z-10 h-[720px] bg-[radial-gradient(circle_at_70%_10%,rgba(200,148,47,0.20),transparent_34%),linear-gradient(180deg,rgba(251,250,247,1),rgba(251,250,247,0))] dark:bg-[radial-gradient(circle_at_70%_10%,rgba(200,148,47,0.20),transparent_34%),linear-gradient(180deg,rgba(10,10,10,1),rgba(10,10,10,0))]"></div>
                <div class="cyb-container grid items-center gap-12 pb-20 lg:grid-cols-[1fr_0.9fr] lg:pb-28">
                    <div>
                        <div class="inline-flex rounded-full border border-cyb-gold/30 bg-cyb-gold/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-cyb-bronze dark:text-cyb-amber">
                            Carte NFC + profil digital
                        </div>
                        <h1 class="mt-6 max-w-4xl text-4xl font-semibold leading-tight text-cyb-ink dark:text-white sm:text-6xl lg:text-7xl">
                            Partagez votre identité professionnelle en un geste.
                        </h1>
                        <p class="mt-6 max-w-2xl text-base leading-8 text-neutral-600 dark:text-neutral-300 sm:text-lg">
                            Cybcraft réunit carte NFC, QR code, profil public et tableau de bord dans une expérience simple, élégante et toujours à jour.
                        </p>
                        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                            <a href="https://wa.me/message/MXYG42F32WEZE1" class="cyb-button-primary">Demander ma carte</a>
                            <a href="#solution" class="cyb-button-secondary">Découvrir</a>
                        </div>
                        <dl class="mt-10 grid max-w-xl grid-cols-3 gap-3 text-sm">
                            <div class="rounded-lg border border-black/10 bg-white/70 p-4 dark:border-white/10 dark:bg-white/5">
                                <dt class="text-neutral-500 dark:text-neutral-400">Partage</dt>
                                <dd class="mt-1 font-semibold">NFC / QR</dd>
                            </div>
                            <div class="rounded-lg border border-black/10 bg-white/70 p-4 dark:border-white/10 dark:bg-white/5">
                                <dt class="text-neutral-500 dark:text-neutral-400">Profil</dt>
                                <dd class="mt-1 font-semibold">Modifiable</dd>
                            </div>
                            <div class="rounded-lg border border-black/10 bg-white/70 p-4 dark:border-white/10 dark:bg-white/5">
                                <dt class="text-neutral-500 dark:text-neutral-400">Contact</dt>
                                <dd class="mt-1 font-semibold">1 clic</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="relative">
                        <div class="absolute -inset-6 -z-10 rounded-full bg-cyb-gold/15 blur-3xl"></div>
                        <div class="cyb-surface rounded-lg p-4">
                            <div class="aspect-[1.55/1] overflow-hidden rounded-md bg-neutral-950 shadow-gold">
                                <img src="{{ asset('cybCard/metal.jpg') }}" class="h-full w-full object-cover" alt="Carte NFC Cybcraft metal">
                            </div>
                            <div class="mt-4 grid gap-4 sm:grid-cols-[0.9fr_1.1fr]">
                                <div class="rounded-md bg-cyb-ink p-4 text-white dark:bg-black">
                                    <div class="text-xs uppercase tracking-wider text-cyb-amber">Profil live</div>
                                    <div class="mt-16 h-2 w-20 rounded-full bg-cyb-gold"></div>
                                    <div class="mt-3 h-2 w-32 rounded-full bg-white/30"></div>
                                    <div class="mt-3 h-2 w-24 rounded-full bg-white/20"></div>
                                </div>
                                <div class="rounded-md border border-black/10 bg-white p-4 dark:border-white/10 dark:bg-neutral-900">
                                    <div class="flex items-center gap-3">
                                        <div class="grid size-10 place-items-center rounded-full bg-cyb-gold/15 text-cyb-gold">NFC</div>
                                        <div>
                                            <p class="text-sm font-semibold">Connexion instantanée</p>
                                            <p class="text-xs text-neutral-500 dark:text-neutral-400">Sans application</p>
                                        </div>
                                    </div>
                                    <div class="mt-5 space-y-2">
                                        <div class="h-2 rounded-full bg-neutral-200 dark:bg-neutral-700"></div>
                                        <div class="h-2 w-4/5 rounded-full bg-neutral-200 dark:bg-neutral-700"></div>
                                        <div class="h-2 w-2/3 rounded-full bg-cyb-gold/50"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="solution" class="border-y border-black/10 bg-white/55 py-20 dark:border-white/10 dark:bg-white/[0.03]">
                <div class="cyb-container">
                    <div class="max-w-2xl">
                        <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Simple par design</p>
                        <h2 class="mt-3 text-3xl font-semibold sm:text-4xl">Un parcours clair, du premier contact au suivi.</h2>
                    </div>
                    <div class="mt-10 grid gap-4 md:grid-cols-3">
                        @foreach ([
                            ['01', 'Approcher', 'La carte NFC ouvre automatiquement le profil digital sur smartphone compatible.'],
                            ['02', 'Scanner', 'Le QR code reste disponible pour tous les appareils et les partages à distance.'],
                            ['03', 'Enregistrer', 'Le visiteur sauvegarde vos coordonnées ou vous envoie les siennes depuis le profil.'],
                        ] as [$step, $title, $copy])
                            <article class="cyb-card cyb-card-hover">
                                <span class="text-sm font-semibold text-cyb-gold">{{ $step }}</span>
                                <h3 class="mt-8 text-xl font-semibold">{{ $title }}</h3>
                                <p class="mt-3 text-sm leading-7 text-neutral-600 dark:text-neutral-300">{{ $copy }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="cartes" class="py-20">
                <div class="cyb-container">
                    <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
                        <div class="max-w-2xl">
                            <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Collection</p>
                            <h2 class="mt-3 text-3xl font-semibold sm:text-4xl">Des cartes sobres, premium et mémorables.</h2>
                        </div>
                        <a href="https://wa.me/message/MXYG42F32WEZE1" class="cyb-button-secondary w-fit">Parler à Cybcraft</a>
                    </div>

                    <div class="mt-10 grid gap-5 md:grid-cols-3">
                        @foreach ([
                            ['Essentiel', 'PVC durable, léger, parfait pour démarrer.', 'cybCard/essential.jpg'],
                            ['Standard', 'Finition élégante pour profils commerciaux.', 'cybCard/standard.jpg'],
                            ['Metal', 'Présence forte, finition premium et toucher dense.', 'cybCard/metal.jpg'],
                        ] as [$name, $copy, $image])
                            <article class="group">
                                <div class="aspect-[1.58/1] overflow-hidden rounded-lg bg-neutral-900 shadow-soft">
                                    <img src="{{ asset($image) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" alt="Carte Cybcraft {{ $name }}">
                                </div>
                                <div class="mt-4">
                                    <h3 class="text-xl font-semibold">{{ $name }}</h3>
                                    <p class="mt-2 text-sm leading-6 text-neutral-600 dark:text-neutral-300">{{ $copy }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="profil" class="bg-cyb-ink py-20 text-white dark:bg-black">
                <div class="cyb-container grid items-center gap-12 lg:grid-cols-[0.85fr_1fr]">
                    <div class="mx-auto w-full max-w-sm rounded-[2rem] border border-white/10 bg-neutral-950 p-3 shadow-gold">
                        <div class="overflow-hidden rounded-[1.5rem] bg-neutral-900">
                            <div class="h-28 bg-cyb-gold"></div>
                            <div class="-mt-10 px-6 pb-6">
                                <img src="{{ asset('avatar.png') }}" class="size-24 rounded-full border-4 border-neutral-900 object-cover" alt="Apercu profil Cybcraft">
                                <h3 class="mt-4 text-xl font-semibold">Votre nom</h3>
                                <p class="text-sm text-neutral-400">Fonction ou entreprise</p>
                                <button class="mt-6 w-full rounded-md bg-cyb-gold px-4 py-3 text-sm font-semibold text-white">Enregistrer le contact</button>
                                <div class="mt-5 grid grid-cols-4 gap-2">
                                    @foreach (['Mail', 'Tel', 'Web', 'QR'] as $item)
                                        <div class="grid aspect-square place-items-center rounded-md bg-white/8 text-xs text-cyb-amber">{{ $item }}</div>
                                    @endforeach
                                </div>
                                <div class="mt-5 space-y-3">
                                    <div class="rounded-md border border-white/10 bg-white/5 p-3">
                                        <p class="text-xs uppercase tracking-wider text-neutral-500">Bio</p>
                                        <p class="mt-1 text-sm text-neutral-300">Une presence digitale professionnelle, claire et partageable.</p>
                                    </div>
                                    <div class="rounded-md border border-white/10 bg-white/5 p-3">
                                        <p class="text-xs uppercase tracking-wider text-neutral-500">Liens</p>
                                        <p class="mt-1 text-sm text-neutral-300">LinkedIn, WhatsApp, site web, portfolio.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-semibold uppercase tracking-wider text-cyb-amber">Profil public</p>
                        <h2 class="mt-3 text-3xl font-semibold sm:text-5xl">Un profil qui reste propre, même quand vos informations changent.</h2>
                        <p class="mt-6 max-w-2xl leading-8 text-neutral-300">
                            L’utilisateur met à jour son profil, ses réseaux, ses fichiers et ses services depuis son espace. La carte physique ne change pas; l’expérience digitale reste toujours actuelle.
                        </p>
                        <div class="mt-8 grid gap-3 sm:grid-cols-2">
                            @foreach (['Informations personnelles', 'Réseaux sociaux', 'Fichiers et services', 'QR code intégré'] as $feature)
                                <div class="rounded-md border border-white/10 bg-white/5 p-4 text-sm font-medium">{{ $feature }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-20">
                <div class="cyb-container">
                    <div class="grid gap-4 md:grid-cols-4">
                        @foreach ([
                            ['Écologique', 'Moins de papier, une carte durable.'],
                            ['Économique', 'Une carte, des informations illimitées.'],
                            ['Compatible', 'NFC, QR code et navigateur mobile.'],
                            ['Professionnel', 'Image cohérente à chaque rencontre.'],
                        ] as [$title, $copy])
                            <article class="cyb-card">
                                <h3 class="font-semibold">{{ $title }}</h3>
                                <p class="mt-3 text-sm leading-6 text-neutral-600 dark:text-neutral-300">{{ $copy }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <section id="contact" class="pb-20">
                <div class="cyb-container">
                    <div class="overflow-hidden rounded-lg bg-cyb-gold p-8 text-white shadow-gold sm:p-12 lg:p-16">
                        <div class="grid gap-8 lg:grid-cols-[1fr_auto] lg:items-center">
                            <div>
                                <h2 class="text-3xl font-semibold sm:text-5xl">Prêt à moderniser vos cartes de visite ?</h2>
                                <p class="mt-4 max-w-2xl text-white/85">Cybcraft vous accompagne sur le choix de la carte, la configuration du profil et la mise en route.</p>
                            </div>
                            <a href="https://wa.me/message/MXYG42F32WEZE1" class="inline-flex items-center justify-center rounded-md bg-white px-6 py-3 text-sm font-semibold text-cyb-bronze transition hover:bg-neutral-100">Commander sur WhatsApp</a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="border-t border-black/10 py-10 dark:border-white/10">
            <div class="cyb-container flex flex-col justify-between gap-6 text-sm text-neutral-500 dark:text-neutral-400 md:flex-row md:items-center">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('LOGOS/Original Couleur.svg') }}" class="h-9 w-auto dark:hidden" alt="{{ config('app.name', 'Cybcraft') }}">
                    <img src="{{ asset('LOGOS/Couleur Blanc.jpg') }}" class="hidden h-9 w-auto rounded-sm dark:block" alt="{{ config('app.name', 'Cybcraft') }}">
                    <span>Réseautage simplifié.</span>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="tel:+243847099942" class="hover:text-cyb-gold">+243 847 099 942</a>
                    <a href="mailto:contact@mycybcraft.com" class="hover:text-cyb-gold">contact@mycybcraft.com</a>
                    <span>&copy; {{ date('Y') }} {{ config('app.name', 'Cybcraft') }}</span>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
