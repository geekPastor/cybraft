<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #modal, #bgmodal {
       z-index: 1000; /* Assurez-vous que la modale est toujours au-dessus */
     }

     #menu {
       z-index: 500; /* Assurez-vous que le menu ne passe pas au-dessus de la modale */
     }
        .text-customBrown {
            color: #905800;
        }

        .bg-customBrown {
            background-color: #905800;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: top;
        }

        .profile-pic-sd{
            border: 4px solid #905800;
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.6);
        }

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
            animation: slide-in 0.3s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Profile Header -->
    <div class="relative w-full h-60">
        
        <!-- Overlay -->
        @if(!empty($picture))
         <img src="/storage/{{$picture->picture}}"  class="w-full h-full object-cover">
        @endif
        
        <div class="absolute top-0 left-0 w-full h-full overlay"></div>
        <!-- Profile Information -->
        <div class="absolute inset-0 flex flex-col items-center justify-center w-full h-full"> 
            <div class="hidden md:flex flex-col items-center justify-center">
                <div class="relative w-32 h-32">
                    @if(!isset($user->picture->picture))
                    <img src="https://via.placeholder.com/150" alt="Profile Picture" class="w-full h-full rounded-full object-cover border-2 border-gray-300">
                    @else
                    <img src="/storage/{{$user->picture->picture}}" alt="Profile Picture" class="w-full h-full rounded-full object-cover border-2 border-gray-300">
                    @endif
                    <!-- Bouton pour modifier l'image -->
                    @auth
                    <button id="editBtn" class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 hover:bg-blue-700 focus:outline-none">
                      +
                    </button>
                    <button id="bgEditBtn" class="absolute bottom-0 right-24 bg-red-600 btn-red rounded-full p-2 hover:bg-red-700 focus:outline-none">
                        +
                    </button>
                    @endauth
                  </div>
                
                <div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white p-8 rounded-lg w-80">

                      <h2 class="text-lg font-bold mb-4">Modifier la photo de profil</h2>
                      
                      <!-- Formulaire pour modifier l'image -->
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
                  <!--bg-->
                  <div id="bgmodal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                    <div class="bg-white p-8 rounded-lg w-80">

                      <h2 class="text-lg font-bold mb-4">Modifier le background</h2>
                      
                      <!-- Formulaire pour modifier l'image -->
                      <form id="profileForm" action={{Route("background",['user'=>$user->id])}} method="POST" enctype="multipart/form-data">
                        <input type="file" name="picture" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                        @csrf
                        <div class="mt-4 flex justify-end">
                          <button type="button" id="bgcloseModal" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2 hover:bg-gray-600">Annuler</button>
                          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Enregistrer</button>
                        </div>
                      </form>
                    </div>
                  </div>
                <h1 class="text-white text-2xl font-bold mt-4">{{$user->name}}</h1>
                <p class="text-white">{{$user->profil->profession ?? " "}}</p>
            </div>
        </div>
        <!-- Menu Icon -->
        <div class="absolute top-4 right-4 text-white cursor-pointer" id="menuIcon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </div>
    </div>

    <!-- Menu -->
    @auth
    <div id="menu" class="hidden z-50 absolute top-16 right-4 bg-white rounded-lg shadow-lg p-6 w-60 transform transition-transform duration-300">
        <ul class="flex flex-col items-start">
            <li class="py-2 text-center text-xl"><a href="{{Route('profil.update',['user'=>$user->id])}}" class="block text-customBrown"><i class="fa-solid fa-pen-to-square"></i> Modifier</a></li>
            
            <li class="py-2 text-center text-xl"><a href="{{Route('profil.qr',['user'=>$user->id])}}" class="block text-customBrown"><i class="fa-solid fa-share-nodes"></i> Partager le profile</a></li>
            
        </ul>
    </div>
    @endauth
    <!-- Main Content -->
    <div class="container mx-auto p-3">
        <div class="bg-white shadow-lg relative rounded-lg">

            <div class="block md:hidden relative bottom-24 flex flex-col items-center mt-6">
                <img src="profile-picture.jpg" alt="Profile Picture" class="profile-pic profile-pic-sd">
                <h1 class="text-customBrowntext-2xl font-bold mt-4">{{$user->name}}</h1>
                <p class="text-customBrown">UI/UX Designer</p>

                <div class="pt-4 flex gap-4 items-center justify-center">
                    <a href="" class="p-4 bg-customBrown text-white rounded-lg">Enregister</a>
                    <a href="" class="p-4 bg-customBrown text-white rounded-lg">Echanger des contacts</a>
                </div>
            </div>


            <div class="p-6 flex flex-col md:flex-row justify-between w-full relative bottom-16 md:bottom-0">
                <div class="w-full md:w-5/12 mb-6 md:mb-0">
                    <h2 class="text-2xl font-bold mb-4 text-customBrown hidden md:block">A Propos de Moi</h2>
                    <ul class="md:mt-4">
                        <li class="mb-4"><strong><i class="fa-solid fa-envelope mr-2"></i></strong><a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
                        <li class="mb-4"><strong><i class="fa-solid fa-phone mr-2"></i></strong><a href="tel:+243987654321">{{$user->profil->number ?? " "}}</a></li>
                        <li class="mb-4"><strong><i class="fa-solid fa-cake-candles"></i></strong> {{$user->profil->naissance ?? " "}}</li>
                        <li class="mb-4"><strong><i class="fa-solid fa-location-dot mr-2"></i></strong>{{$user->profil->domicile ?? " "}}</li>
                        <li class="mb-4"><strong><i class="fa-solid fa-business-time"></i></strong> {{$user->profil->nom_entite ?? " "}}</li>
                    </ul>
                
                    <!-- Mes Réseaux Sociaux -->
                    <div class="bg-white p-6 md:mt-0 block md:hidden">
                        <h2 class="text-gray-500 text-2xl font-bold mb-4">Mes Réseaux Sociaux</h2>
                        <div class="flex flex-wrap space-x-4">
                            <div class="w-full flex justify-around mb-4">
                                <a href="#"><i class="fab fa-facebook text-4xl text-blue-600"></i></a>
                                <a href="#"><i class="fa-brands fa-x-twitter text-4xl text-black"></i></a>
                                <a href="#"><i class="fa-brands fa-threads text-4xl text-black"></i></a>
                                <a href="#"><i class="fab fa-instagram text-4xl text-black"></i></a>
                                <a href="#"><i class="fab fa-linkedin text-4xl text-blue-700"></i></a>
                            </div>
                            <div class="w-full flex justify-around mb-4">
                                <a href="#"><i class="fab fa-snapchat text-4xl text-yellow-500"></i></a>
                                <a href="#"><i class="fab fa-tiktok text-4xl text-black"></i></a>
                                <a href="#"><i class="fab fa-telegram text-4xl text-blue-400"></i></a>
                                <a href="#"><i class="fab fa-whatsapp text-4xl text-green-500"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-6/12">
                    <h2 class="text-2xl font-bold mb-2 text-customBrown">En savoir Plus sur Moi</h2>
                    <p class="mb-4">{{$user->profil->bio ?? " "}}</p>

                    <h2 class="text-2xl font-bold mb-2 text-customBrown">Mes Compétences</h2>
                    <p class="mb-4">{{$user->profil->competences ?? " "}}</p>
                </div>
            </div>
        </div>
        
        
        
        <div class="w-full pt-4 container mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 md:mt-0 flex flex-col-reverse md:flex-row">
            <!-- Nom de l'entité -->
            <div class="bg-white shadow-lg rounded-lg p-6 md:order-2 w-full">
                <h2 class="text-2xl font-bold mb-4 text-customBrown">Nom de l'entité</h2>
                <p class="mb-4">Maker-Corporation <a href="./about.html" class="bg-customBrown text-white py-1 px-2 rounded">En savoir plus</a></p>
                <!-- Mes Réseaux Sociaux -->
                <div class="bg-white hidden md:block  p-6 mt-6 md:mt-0">
                    <h2 class="text-gray-500 text-2xl font-bold mb-4">Mes Réseaux Sociaux</h2>
                    <div class="flex flex-wrap space-x-4">
                        <div class="w-full flex justify-around mb-4">
                          @php
                              $tiktok="Tik Tok"
                          @endphp
                            <a href={{$user->profil->reseau->Facebook ?? " "}}><i class="fab fa-facebook text-4xl text-blue-600"></i></a>
                            <a href={{$user->profil->reseau->twitter ?? " "}}><i class="fa-brands fa-x-twitter text-4xl text-black"></i></a>
                            <a href={{$user->profil->reseau->Theads ?? " "}}><i class="fa-brands fa-threads text-4xl text-black"></i></a>
                            <a href={{$user->profil->reseau->Instagram ?? " "}}><i class="fab fa-instagram text-4xl text-black"></i></a>
                            <a href={{$user->profil->reseau->Linkedin ?? " "}}><i class="fab fa-linkedin text-4xl text-blue-700"></i></a>
                        </div>
                        <div class="w-full flex justify-around mb-4"> 
                            <a href="#"><i class="fab fa-snapchat text-4xl text-yellow-500"></i></a>
                            <a href={{$user->profil->reseau->$tiktok ?? " "}}><i class="fab fa-tiktok text-4xl text-black"></i></a>
                            <a  href={{$user->profil->reseau->Telegram ?? " "}}><i class="fab fa-telegram text-4xl text-blue-400"></i></a>
                            <a href="#"><i class="fab fa-whatsapp text-4xl text-green-500"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Liés -->
            <div class="bg-white shadow-lg rounded-lg p-6  md:order-1">
                <h2 class="text-gray-500 text-2xl font-bold mb-4">Services Liés</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-200 p-4 rounded-lg flex flex-col items-center justify-center">
                        <i class="fa-solid fa-bolt text-4xl mb-2"></i>
                        <span>Impressions</span>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg flex flex-col items-center justify-center">
                        <i class="fa-solid fa-bolt text-4xl mb-2"></i>
                        <span>Impressions</span>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg flex flex-col items-center justify-center">
                        <i class="fa-solid fa-bolt text-4xl mb-2"></i>
                        <span>Impressions</span>
                    </div>
                    <div class="bg-gray-200 p-4 rounded-lg flex flex-col items-center justify-center">
                        <i class="fa-solid fa-bolt text-4xl mb-2"></i>
                        <span>Impressions</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 py-8 mt-16">
        <div class="container mx-auto text-center">
            <img src="logo.png" alt="Logo" class="mx-auto mb-4" style="max-width: 150px;">
            <p class="text-gray-400">© 2024 Cybcraft. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const menuIcon = document.getElementById('menuIcon');
        const menu = document.getElementById('menu');

        menuIcon.addEventListener('click', () => {
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
                menu.classList.add('flex', 'animate-slide-in');
            } else {
                menu.classList.remove('flex', 'animate-slide-in');
                menu.classList.add('hidden');
            }
        });
    document.getElementById('editBtn').addEventListener('click', function() {
    const modal = document.getElementById('modal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');  // Ajout de la classe flex pour centrer les éléments
});

document.getElementById('closeModal').addEventListener('click', function() {
    const modal = document.getElementById('modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex'); // Retirer la classe flex pour éviter tout conflit
});
document.getElementById('bgEditBtn').addEventListener('click', function() {
    const modal = document.getElementById('bgmodal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');  // Ajout de la classe flex pour centrer les éléments
});
document.getElementById('bgcloseModal').addEventListener('click', function() {
    const modal = document.getElementById('bgmodal');
    modal.classList.add('hidden');
    modal.classList.remove('flex'); // Retirer la classe flex pour éviter tout conflit
});
    </script>
</body>
</html>