<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full h-4/5 max-w-md">
            <div class="bg-white p-8 rounded shadow-md text-center">
                <h1 class="text-3xl font-bold mb-6">Cyb<span class="text-black">Craft</span></h1>
                <div class="w-32 h-32 bg-gray-300 mx-auto overflow-hidden">
                    <img src="/qr.png" alt="Profile Picture" class="w-full h-full object-cover border-2 border-gray-300">
                </div>
                <div class="space-y-4 pt-2">
                    <form action={{Route("profil.supprimeDestrroy",['name'=>$user->name])}} method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
                        @csrf
                    <button class="bg-yellow-700 text-white py-2 px-4 rounded w-full">supprimer mon profil</button>
                    </form>
                    <a id="shareButton" class="w-full bg-yellow-700 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mt-2 inline-block text-center" href="#">Partager Mon Profil</a>
                    <!-- Menu de partage -->
                    <div id="shareMenu" class="hidden mt-2 bg-white rounded shadow-lg">
                        <button id="copyLinkButton" class="block px-4 py-2 text-gray-800 hover:bg-gray-200 w-full text-left">Copier le lien</button>
                        <a href="https://wa.me/?text=Partager%20le%20lien%20de%20mon%20profil" target="_blank" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">WhatsApp</a>
                        <a href="sms:?body=Partager%20le%20lien%20de%20mon%20profil" target="_blank" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">SMS</a>
                        <a href="mailto:?subject=Partager%20le%20lien%20de%20mon%20profil" target="_blank" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-blue-950 py-8 mt-16">
        <div class="container mx-auto text-center">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="mx-auto mb-4" style="max-width: 150px;">
            <p class="text-gray-400">&copy; 2024 Cybcraft. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Récupérer le lien généré par Laravel
        var profileLink = '{{ Route("profil.compte", ["name" => $user->name]) }}';

        // Affichage du menu de partage
        document.getElementById('shareButton').addEventListener('click', function(event) {
            event.preventDefault();
            var menu = document.getElementById('shareMenu');
            menu.classList.toggle('hidden');
        });

        // Copier le lien dans le presse-papiers
        document.getElementById('copyLinkButton').addEventListener('click', function() {
            navigator.clipboard.writeText(profileLink).then(function() {
                alert('Lien copié dans le presse-papiers !');
            }, function(err) {
                console.error('Erreur lors de la copie : ', err);
            });
        });

        // Fermer le menu si on clique à l'extérieur
        window.addEventListener('click', function(e) {
            var menu = document.getElementById('shareMenu');
            if (!document.getElementById('shareButton').contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
