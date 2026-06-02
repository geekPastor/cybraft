<nav class="fixed top-0 z-50 w-full border-b border-black/10 bg-white/85 backdrop-blur dark:border-white/10 dark:bg-neutral-950/85">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button id="sidebar-humberger" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center rounded-md p-2 text-sm text-neutral-600 hover:bg-cyb-gold/10 hover:text-cyb-gold focus:outline-none focus:ring-2 focus:ring-cyb-gold sm:hidden dark:text-neutral-300">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="{{ url('/') }}" class="ms-2 flex items-center gap-3 md:me-24">
                    <img src="{{ asset('LOGOS/Original Couleur.svg') }}" class="h-10 w-auto dark:hidden" alt="{{ Config::get('app.name') }}" />
                    <img src="{{ asset('LOGOS/Couleur Blanc.jpg') }}" class="hidden h-10 w-auto rounded-sm dark:block" alt="{{ Config::get('app.name') }}" />
                    <span class="hidden self-center whitespace-nowrap text-lg font-semibold text-cyb-ink sm:block dark:text-white">{{ Config::get('app.name'); }}</span>
                </a>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" data-theme-toggle class="grid size-10 place-items-center rounded-full border border-black/10 bg-white text-cyb-ink transition hover:border-cyb-gold hover:text-cyb-gold dark:border-white/10 dark:bg-white/5 dark:text-neutral-100">
                    <span class="sr-only">Changer le mode d'affichage</span>
                    <svg class="size-5 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 15.25A9 9 0 0 1 8.75 2.25 7.5 7.5 0 1 0 21.75 15.25Z" />
                    </svg>
                    <svg class="hidden size-5 dark:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.36-6.36-1.59 1.59M7.23 16.77l-1.59 1.59m12.72 0-1.59-1.59M7.23 7.23 5.64 5.64M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Z" />
                    </svg>
                </button>
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" id="dropdown-user-open-menu" class="flex rounded-full bg-neutral-900 text-sm ring-2 ring-cyb-gold/20 transition focus:ring-4 focus:ring-cyb-gold/30" aria-expanded="false" data-dropdown-toggle="dropdown-user-menu">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->getImageUrl() }}" alt="user photo">
                        </button>
                    </div>
                    <div class="absolute right-0 top-12 z-50 my-4 hidden min-w-72 list-none divide-y divide-black/10 rounded-lg border border-black/10 bg-white text-base shadow-soft dark:divide-white/10 dark:border-white/10 dark:bg-neutral-900 sm:right-4" id="dropdown-user-menu">
                        <div class="px-4 py-3" role="none">
                            <p class="text-md text-cyb-ink dark:text-white" role="none">
                                {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
                            </p>
                            <p class="text-md truncate font-medium text-neutral-500 dark:text-neutral-400" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            @user
                                <li>
                                    <a href="{{ route('profil.compte', Auth::user()->getRouteKey()) }}" class="block px-4 py-2 text-md text-neutral-700 hover:bg-cyb-gold/10 hover:text-cyb-gold dark:text-neutral-200" role="menuitem">Voir mon profil</a>
                                </li>
                                <li>
                                    <a href="{{ route('profil.update', Auth::user()->getRouteKey()) }}" class="block px-4 py-2 text-md text-neutral-700 hover:bg-cyb-gold/10 hover:text-cyb-gold dark:text-neutral-200" role="menuitem">Modifier mon profil</a>
                                </li>
                                <li>
                                    <a href="{{ route('password.edit', Auth::user()->getRouteKey()) }}" class="block px-4 py-2 text-md text-neutral-700 hover:bg-cyb-gold/10 hover:text-cyb-gold dark:text-neutral-200" role="menuitem">Modifier mon mot de passe</a>
                                </li>
                            @enduser
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    
                                    <a 
                                        href="#" 
                                        class="block px-4 py-2 text-md text-neutral-700 hover:bg-cyb-gold/10 hover:text-cyb-gold dark:text-neutral-200" role="menuitem"
                                        onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                        >Se deconnecter</a>
                                </form>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
    
<aside id="logo-sidebar" class="fixed left-0 top-14 z-40 h-screen w-72 -translate-x-full border-r border-black/10 bg-white transition-transform dark:border-white/10 dark:bg-neutral-950 sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full overflow-y-auto px-3 py-6">
        <ul class="space-y-2 mt-3 font-medium">

            <li>
                @admin
                    <x-nav-link href="{{ route('users.index') }}" text="Utilisateurs" @class(['bg-cyb-gold/15 text-cyb-gold' => Route::currentRouteName() == "users.index" or Route::currentRouteName() == "users.show"])>
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </x-nav-link>
                @else
                    <x-nav-link href="{{ route('profil.compte', Auth::user()->getRouteKey()) }}" text="Accéder à mon profil">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </x-nav-link>

                    <x-nav-link href="{{ route('entities.create') }}" text="Mon entité">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </x-nav-link>

                    <x-nav-link href="{{ route('profil.qr', Auth::user()->getRouteKey()) }}" text="Voir mon QR Code">
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </x-nav-link>

                    <x-nav-link href="{{ route('contacts.index') }}" text="Contacts" @class(['bg-cyb-gold/15 text-cyb-gold' => Route::currentRouteName() == "contacts.index" or Route::currentRouteName() == "contacts.show"])>
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </x-nav-link>

                @endadmin
            </li>

        </ul>
    </div>
</aside>
