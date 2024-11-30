<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$user->name}}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite('resources/css/app.css')
    <style>
        @keyframes slide-in {
            from {
                opacity: 0;
                transform: translateX(10px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-in-out forwards;
        }

        .customBG{
            width: 60%;
        }

        .insta{
            color: #dd1669
        }

        .link{
            color: #0077B5;
        }

        .what{
            color: #25D366;
        }

        .snap{
            color: #FFFC00;
        }

        .twit{
           color: #1DA1F2;
        }

        .you{
            color: #FF0000;
        }
        #modal, #bgmodal {
       z-index: 1000; /* Assurez-vous que la modale est toujours au-dessus */
     }
    </style>
</head>
<body class="bg-blue-50">
   
    <div class="flex justify-end p-4 text-black cursor-pointer">
        <button id="menuIcon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
        </button>
    </div>
   
    <div id="sideMenu" class="hidden z-50 absolute top-16 right-4 bg-white rounded-lg shadow-lg p-6 w-80 transform transition-transform duration-300">
        <!-- Contenu du menu latéral -->
        <div class="p-6 flex flex-col justify-center items-center">
            <h2 class="text-xl font-bold pb-4">CybCard</h2>
            <div class="w-40 h-40 bg-gray-300 mx-auto overflow-hidden">
                {!! $qrCode !!}
            </div>
            <div class="flex justify-center flex-col mt-6 gap-2">
                @auth
                    @if (Auth::id() == $user->id) 
                    
                        <a class="px-6 py-2 hover:bg-indigo-950 hover:text-white text-indigo-950 md-w-full rounded-md border-2 border-indigo-950 duration-300" href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-download" ></i> Accéder à mon Dashboard
                        </a>
                        <a class="px-6 py-2 hover:bg-indigo-950 hover:text-white text-indigo-950 rounded-md border-2 border-indigo-950 duration-300" href="{{Route('profil.update',$user->getRouteKey())}}">
                            <i class="fa-solid fa-share-from-square"></i> Modifier mes informations
                        </a>
                        <a class="px-6 py-2 hover:bg-indigo-950 hover:text-white text-indigo-950 rounded-md border-2 border-indigo-950 duration-300" href="{{ route('password.edit') }}">
                            <i class="fa-solid fa-share-from-square"></i> Modifier le mot de passe
                        </a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="px-6 py-2 w-full text-start hover:bg-indigo-950 hover:text-white text-indigo-950 rounded-md border-2 border-indigo-950 duration-300">
                                <i class="fa-solid fa-share-from-square"></i> Se déconnecter
                            </button>
                        </form>
                        
                    @else
                        <a class="px-6 py-2 hover:bg-indigo-950 hover:text-white text-indigo-950 rounded-md border-2 border-indigo-950 duration-300" href="{{ route('login') }}">
                            <i class="fa-solid fa-share-from-square"></i> Se connecter
                        </a>
                        <a class="px-6 py-2 hover:bg-indigo-950 hover:text-white text-indigo-950 rounded-md border-2 border-indigo-950 duration-300" href="https://wa.me/message/MXYG42F32WEZE1">
                            <i class="fa-solid fa-share-from-square"></i> Obtenir ma carte WmCard
                        </a>
                    @endif
                @else
                    <a class="px-6 py-2 hover:bg-indigo-950 hover:text-white text-indigo-950 rounded-md border-2 border-indigo-950 duration-300" href="{{ route('login') }}">
                        <i class="fa-solid fa-share-from-square"></i> Se connecter
                    </a>
                    <a class="px-6 py-2 hover:bg-indigo-950 hover:text-white text-indigo-950 rounded-md border-2 border-indigo-950 duration-300" href="https://wa.me/message/MXYG42F32WEZE1">
                        <i class="fa-solid fa-share-from-square"></i> Obtenir ma carte WmCard
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="text-center py-8">
            <div class="w-32 h-32 bg-gray-300 rounded-full mx-auto overflow-hidden" id="editBtn">
                @if(!isset($user->picture->picture))
                <img src="/black.jpeg" alt="Profile Picture" class="w-full h-full rounded-full object-cover border-2 border-gray-300">
                @else
                <img src="{{ $user->getImageUrl() }}" alt="Profile Picture" class="w-full h-full rounded-full object-cover border-2 border-gray-300">
                @endif
            </div>
            <h1 class="text-2xl font-semibold mt-4">{{$user->name}}</h1>
            <p class="text-gray-600">{{$user->profil->profession ?? " "}}</p>
        </div>
        <!--modification de profil-->
        @auth
            @if (Auth::id() == $user->id) 
                <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white p-8 rounded-lg w-80">

                    <h2 class="text-lg font-bold mb-4">Modifier la photo de profil</h2>
                    
                    
                    <form id="profileForm" action={{Route("uppload",['user'=>$user->id])}} method="POST" enctype="multipart/form-data">
                        <input type="file" name="picture" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                        @csrf
                        <div class="mt-4 flex justify-end">
                        <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600">Annuler</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Enregistrer</button>
                        </div>
                    </form>
                    </div>
                </div>
            @endif
        @endauth
        <!--fin-->
        <div class="border-t border-gray-200"></div>
            
            <!-- php -S 172.16.13.54:8000 -->

        <div class="p-6 flex flex-col md:flex-row justify-between w-full relative bottom-16 md:bottom-0">
            <div class="w-full md:w-5/12 mb-6 md:mb-0 pt-14 md:pt-0">
                <h2 class="text-2xl font-bold mb-4 text-customBrown hidden md:block">A Propos de Moi</h2>
                <ul class="md:mt-4">
                    <li class="mb-4">
                        <a class="flex items-center bg-white shadow-md rounded-md p-4" href="mailto:{{$user->email}}">
                            <div class="bg-blue-950 p-2 rounded-l-md text-white">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-700 font-semibold">Adresse email :</p>
                                <p class="text-gray-600 break-words">{{$user->email ?? " "}}</p>
                            </div>
                        </a>
                    </li>
                    <li class="mb-4">
                        <a class="flex items-center bg-white shadow-md rounded-md p-4" href="tel:{{$user->profil?->number}}">
                            <div class="bg-blue-950 p-2 rounded-l-md text-white">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-700 font-semibold">Téléphone :</p>
                                <p class="text-gray-600">
                                    @if ($user->profil?->number && $user->profil?->number2)
                                        {{$user->profil->number}} / {{$user->profil->number2}}
                                    @else
                                        {{$user->profil?->number ?? $user->profil?->number2 ?? 'Indisponible'}}
                                    @endif
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="mb-4">
                        <div class="flex items-center bg-white shadow-md rounded-md p-4">
                            <div class="bg-blue-950 p-2 rounded-l-md text-white">
                                <i class="fa-solid fa-building"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-700 font-semibold">
                                    @if ($user->entity)
                                        Nom {{ $user->entity->type->name }} :
                                    @else
                                        Société :
                                    @endif
                                </p>
                                <p class="text-gray-600">
                                    {{$user->entity->name ?? "Indisponible"}}
                                    @auth
                                        @if (Auth::id() == $user->id) 
                                            (<x-link href="{{ route('entities.create') }}">Editer</x-link>)
                                        @endif
                                    @endauth
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="mb-4">
                        <div class="flex items-center bg-white shadow-md rounded-md p-4">
                            <div class="bg-blue-950 p-2 rounded-l-md text-white">
                                <i class="fa-regular fa-map"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-700 font-semibold">
                                @if ($user->entity) 
                                    Adresse {{ $user->entity->type->name }} :
                                @else 
                                    Adresse entité :
                                @endif</p>
                                <p class="text-gray-600">{{$user->entity->address ?? "Indisponible"}}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            @hasSocial($user)
                <div class="pb-2 block md:hidden">
                    <h2 class="text-blue-950 text-2xl text-center font-bold mb-4">Mes Réseaux Sociaux</h2>
                    <!-- Ajoutez les icônes des réseaux sociaux ici -->
                    <div class="flex justify-center items-center space-x-4 mt-8 gap-16 flex-wrap text-blue-950">
                        @if(!empty($user->profil->reseau->facebook) && $user->profil->reseau->facebook != "https://")                  
                        <a href={{$user->profil->reseau->facebook}} class="text-3xl"><i class="fab fa-facebook text-4xl text-blue-600"></i></a>
                        @endif
                        @if(!empty($user->profil->reseau->twitter) && $user->profil->reseau->twitter != "https://") 
                        <a href={{$user->profil->reseau->twitter}} class="text-3xl"><i class="fa-brands fa-twitter text-4xl text-blue-600"></i></a>
                        @endif
                        @if(!empty($user->profil->reseau->theads) && $user->profil->reseau->theads != "https://")
                        <a href={{$user->profil->reseau->theads}} class="text-3xl">
                            <img class="h-8" src="{{ asset('threads.png') }}" />
                        </a>
                        @endif
                        @if(!empty($user->profil->reseau->instagram) && $user->profil->reseau->instagram != "https://")
                        <a href={{$user->profil->reseau->instagram}} class="text-3xl insta"><i class="fab fa-instagram text-4xl text-black"></i></a>
                        @endif
                        @if(!empty($user->profil->reseau->linkedin) && $user->profil->reseau->linkedin != "https://")
                        <a href="{{$user->profil->reseau->linkedin}}" class="text-3xl link"><i class="fab fa-linkedin text-4xl text-blue-700"></i></a>
                        @endif
                        @if(!empty($user->profil->reseau->telegram) && $user->profil->reseau->telegram != "https://")
                        <a href={{$user->profil->reseau->telegram}} class="text-3xl link"><i class="fa-brands fa-telegram text-4xl text-blue-700"></i></a>
                        @endif
                        @if(!empty($user->profil->reseau->whatsapp) && $user->profil->reseau->whatsapp != "https://")
                        <a href={{$user->profil->reseau->whatsapp}} class="text-3xl link"><i class="fa-brands fa-whatsapp text-4xl text-green-700"></i></a>
                        @endif
                        @if(!empty($user->profil->reseau->tiktok) && $user->profil->reseau->tiktok != "https://")
                        <a href={{$user->profil->reseau->tiktok}} class="text-3xl link"><i class="fa-brands fa-tiktok text-4xl text-black"></i></a>
                        @endif
                    </div>
                </div>
            @endhasSocial
            <div class="w-full md:w-6/12">
                <h2 class="text-2xl font-bold mb-2 text-blue-950">En savoir Plus sur Moi</h2>
                <p class="mb-4">{{$user->profil->bio ?? "Rien a été fourni."}}</p>
            </div>
        </div>
      
        
        @hasSocial($user) 
            <div class="pb-2  hidden md:block">
                <h2 class="text-blue-950 text-2xl text-center font-bold mb-4">Mes Réseaux Sociaux</h2>
                <div class="flex justify-center items-center space-x-4 mt-8 gap-16 flex-wrap text-blue-950">
                    @if(!empty($user->profil->reseau->facebook) && $user->profil->reseau->facebook != "https://")                  
                      <a href={{$user->profil->reseau->facebook}} class="text-3xl"><i class="fab fa-facebook text-4xl text-blue-600"></i></a>
                    @endif
                    @if(!empty($user->profil->reseau->twitter) && $user->profil->reseau->twitter != "https://") 
                      <a href={{$user->profil->reseau->twitter}} class="text-3xl"><i class="fa-brands fa-twitter text-4xl text-blue-600"></i></a>
                    @endif
                    @if(!empty($user->profil->reseau->theads) && $user->profil->reseau->theads != "https://")
                    <a href={{$user->profil->reseau->theads}} class="text-3xl">
                        <img class="h-8" src="{{ asset('threads.png') }}" />
                    </a>
                    @endif
                    @if(!empty($user->profil->reseau->instagram) && $user->profil->reseau->instagram != "https://")
                      <a href={{$user->profil->reseau->instagram}} class="text-3xl insta"><i class="fab fa-instagram text-4xl text-black"></i></a>
                    @endif
                    @if(!empty($user->profil->reseau->linkedin) && $user->profil->reseau->linkedin != "https://")
                      <a href="{{$user->profil->reseau->linkedin}}" class="text-3xl link"><i class="fab fa-linkedin text-4xl text-blue-700"></i></a>
                    @endif
                    @if(!empty($user->profil->reseau->telegram) && $user->profil->reseau->telegram != "https://")
                      <a href={{$user->profil->reseau->telegram}} class="text-3xl link"><i class="fa-brands fa-telegram text-4xl text-blue-700"></i></a>
                    @endif
                    @if(!empty($user->profil->reseau->whatsapp) && $user->profil->reseau->whatsapp != "https://")
                      <a href={{$user->profil->reseau->whatsapp}} class="text-3xl link"><i class="fa-brands fa-whatsapp text-4xl text-green-700"></i></a>
                    @endif
                    @if(!empty($user->profil->reseau->tiktok) && $user->profil->reseau->tiktok != "https://")
                      <a href={{$user->profil->reseau->tiktok}} class="text-3xl link"><i class="fa-brands fa-tiktok text-4xl text-black"></i></a>
                    @endif
                </div>
            </div>
        @endhasSocial
    
        <div class="flex justify-center items-center flex-col mt-6 gap-4 w-full">
            
            <form id="vcard" action="{{ route('vcard', $user->getRouteKey()) }}" method="post" class="inline-block">
                @csrf
            </form>

            @if ($user->id != Auth::id())
                <button form="vcard" type="submit" class="px-6 py-2 hover:bg-blue-950 hover:text-white text-blue-950 customBG rounded-md border-2 border-blue-950 duration-300 text-center" href="tel:{{$user->profil->number ?? " "}}">
                    <i class="fa-solid fa-download"></i> Enregistrer contact
                </button>
                <button onclick="togglePopup()" class="px-6 py-2 hover:bg-blue-950 hover:text-white text-blue-950 customBG rounded-md border-2 border-blue-950 duration-300">
                    <i class="fa-solid fa-share-from-square"></i> Envoyer mon contact
                </button>
            @endif
        </div>
        
        @if ($user->entity) 
            <div class="mt-12 flex justify-center flex-col-reverse">
                <div class="bg-white rounded-lg p-6 md:order-2 w-full">
                    <h2 class="text-2xl font-bold mb-4 text-blue-950 text-center">Information sur l'entité</h2>
                    <p class="mb-4 text-center uppercase">{{$user->profil->nom_entite ?? ''}} <a href="{{ $user->entity->website }}" class="lowercase hover:bg-blue-950 hover:text-white text-blue-950  py-1 px-2 rounded-md border-2 border-blue-950 duration-300">En savoir plus</a></p>
                </div>
    
                @if ($user->entity) 
                    @if ($user->entity->type->id == 1 or $user->entity->type->id == 2) 
                        <div>
                            <h2 class="text-center text-2xl font-bold text-blue-950 mb-4">Services</h2>
                            
                            @if ($user->entity->services->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-8">
                                    @foreach ($user->entity->services as $service)
                                        <div class="flex items-center bg-white shadow-md rounded-md p-4 hover:cursor-pointer">
                                            <div class="bg-blue-950 p-2 rounded-l-md text-white">
                                                <i class="fa-regular fa-circle-check"></i>
                                            </div>
                                            <div class="ml-4">
                                                <p class="text-gray-700 font-semibold flex">
                                                    {{$service->name}}
                                                    @if (Auth::id() == $user->id) 
                                                        <span class="flex">
                                                            <form action="{{ route('services.destroy', $service) }}" method="post" class="inline" id="deleteService_{{ $loop->iteration }}">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                            <x-link href="{{ route('services.edit', $service) }}">Editer</x-link>
                                                            <button type="submit" class="text-red-500 font-bold hover:underline inline-block" form="deleteService_{{ $loop->iteration }}">Supprimer</button>
                                                        </span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
        
                                @auth
                                    @if (Auth::id() == $user->id) 
                                        <div class="flex justify-center mt-4">
                                            <a href="{{ route('services.create') }}" class="bg-blue-950 text-white rounded-md px-4 py-2">Ajouter un service</a>
                                        </div>
                                    @endif
                                @endauth
                            @else
                                <p class="text-center text-gray-600">Aucun service disponible</p>
            
                                @auth
                                    @if (Auth::id() == $user->id) 
                                        <div class="flex justify-center mt-4">
                                            <a href="{{ route('services.create') }}" class="bg-blue-950 text-white rounded-md px-4 py-2">Ajouter un service</a>
                                        </div>
                                    @endif
                                @endauth
                            @endif        
                        </div>
                    @endif
                @endif
            </div>
        @endif

        @if ($user->files->count() != 0) 
            <div>
                <h2 class="text-2xl font-bold mb-4 text-blue-950 text-center">Mes pièces jointes</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-8">
                @foreach ($user->files as $file)
                    <div class="flex items center bg-white shadow-md rounded-md p-4">
                        <div class="bg-blue-950 p-2 rounded-l-md text-white">
                            <i class="fa-regular fa-file"></i>
                        </div>
                        <div class="ml-4">
                            <a href="{{ asset($file->getUrl()) }}" class="text-blue-500 font-bold hover:underline">{{$file->name}}</a>
                            
                            {{-- Delete the file if authenticated user is owner --}}
                            @auth
                                @if (Auth::id() == $user->id) 
                                    <form action="{{ route('files.destroy', $file) }}" method="post" id="deleteFile_{{ $loop->iteration }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="submit" class="text-red-500 font-bold hover:underline inline-block" form="deleteFile_{{ $loop->iteration }}">Supprimer</button>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-8 mb-4 text-center text-gray-600">
            CybCard
        </div>
    </div>

    <div class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center z-50 hidden" id="popupForm">
        <div class="bg-white shadow-md rounded-md p-6 w-full max-w-lg">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Envoyer mon contact à {{$user->name}}</h2>
                <button class="text-gray-500 hover:text-gray-700" onclick="togglePopup()">X</button>
            </div>

            <form action={{Route("profil.mail",$user->getRouteKey())}} method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}" required>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Nom Complet :</label>
                    <input type="text" id="name" class="w-full border border-gray-300 rounded-md p-2" name="name" placeholder="Nom complet">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email :</label>
                    <input type="email" id="email" class="w-full border border-gray-300 rounded-md p-2" name="email" placeholder="Adresse email">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="phone">Numéro de Téléphone :</label>
                    <input type="tel" id="phone" class="w-full border border-gray-300 rounded-md p-2"  name="phone" placeholder="Numéro de Téléphone">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="address">Adresse :</label>
                    <input type="text" id="address" class="w-full border border-gray-300 rounded-md p-2" name="adresse" placeholder="Adresse, Code postale, Ville">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="notes">Notes :</label>
                    <textarea id="notes" class="w-full border border-gray-300 rounded-md p-2" name="notes" placeholder="Ajouter une note"></textarea>
                </div>
                <div class="mb-4">
                    <input type="text" id="address"  class=" hidden w-full border border-gray-300 rounded-md p-2" name="toMail" value={{$user->email}}>
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-red-500 text-white rounded-md px-4 py-2 mr-2" onclick="togglePopup()">Annuler</button>
                    <button type="submit" class="bg-blue-600 text-white rounded-md px-4 py-2" onclick="togglePopup()">Envoyer</button>
                </div>
            </form>

        </div>
    </div>

    <footer class="bg-blue-950 py-8 mt-16">
        <div class="container mx-auto text-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="mx-auto mb-4" style="max-width: 150px;">
            <p class="text-gray-400">&copy; 2024 Cybcraft. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const menuIcon = document.getElementById('menuIcon');
        const menu = document.getElementById('sideMenu');

        menuIcon.addEventListener('click', () => {
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                menu.classList.add('flex', 'animate-slide-in');
            } else {
                menu.classList.remove('flex', 'animate-slide-in');
                menu.classList.add('hidden');
            }
        });

        function togglePopup() {
            const popupForm = document.getElementById('popupForm');
            popupForm.classList.toggle('hidden');
        }
        document.getElementById('closeModal').addEventListener('click', function() {
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex'); // Retirer la classe flex pour éviter tout conflit
        });
        document.getElementById('editBtn').addEventListener('click', function() {
            const modal = document.getElementById('modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');  // Ajout de la classe flex pour centrer les éléments
        });
    </script>
</body>
</html>