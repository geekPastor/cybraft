<nav class="fixed top-0 z-50 w-full bg-gray-600">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button id="sidebar-humberger" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <a href="{{ url('/') }}" class="flex items-center ms-2 md:me-24">
                    <img src="{{ asset('logo.png') }}" class="h-10 me-3 rounded-full" alt="Site Logo" />
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">{{ Config::get('app.name'); }}</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" id="dropdown-user-open-menu" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user-menu">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->getImageUrl() }}" alt="user photo">
                        </button>
                    </div>
                    <div class="z-50 right-0 sm:right-4 top-12 absolute hidden my-4 text-base list-none bg-gray-700 divide-y divide-gray-100 rounded shadow" id="dropdown-user-menu">
                        <div class="px-4 py-3" role="none">
                            <p class="text-md text-white" role="none">
                                {{ Auth::user()->name }} ({{ Auth::user()->role->name }})
                            </p>
                            <p class="text-md font-medium text-white truncate" role="none">
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                        <ul class="py-1" role="none">
                            @user
                                <li>
                                    <a href="{{ route('profil.compte', Auth::user()->getRouteKey()) }}" class="block px-4 py-2 text-md text-white hover:bg-blue-700" role="menuitem">Voir mon profil</a>
                                </li>
                                <li>
                                    <a href="{{ route('profil.update', Auth::user()->getRouteKey()) }}" class="block px-4 py-2 text-md text-white hover:bg-blue-700" role="menuitem">Modifier mon profil</a>
                                </li>
                                <li>
                                    <a href="{{ route('password.edit', Auth::user()->getRouteKey()) }}" class="block px-4 py-2 text-md text-white hover:bg-blue-700" role="menuitem">Modifier mon mot de passe</a>
                                </li>
                            @enduser
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    
                                    <a 
                                        href="#" 
                                        class="block px-4 py-2 text-md text-white hover:bg-blue-700" role="menuitem"
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
    
<aside id="logo-sidebar" class="fixed top-10 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white sm:translate-x-0 " aria-label="Sidebar">
    <div class="h-full px-3 py-6 overflow-y-auto bg-gray-900">
        <ul class="space-y-2 mt-3 font-medium">

            <li>
                @admin
                    <x-nav-link href="{{ route('users.index') }}" text="Utilisateurs" @class(['bg-blue-700' => Route::currentRouteName() == "users.index" or Route::currentRouteName() == "users.show"])>
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

                    <x-nav-link href="{{ route('contacts.index') }}" text="Contacts" @class(['bg-blue-700' => Route::currentRouteName() == "contacts.index" or Route::currentRouteName() == "contacts.show"])>
                        <i class="fa fa-line-chart" aria-hidden="true"></i>
                    </x-nav-link>

                @endadmin
            </li>

        </ul>
    </div>
</aside>