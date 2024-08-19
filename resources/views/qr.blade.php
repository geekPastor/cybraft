<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center py-4 min-h-screen">
        <div class="w-full max-w-md px-4">
            <div class="bg-white p-8 rounded shadow-md text-center">
                <h1 class="text-3xl font-bold mb-6">Cyb<span class="text-black">Craft</span></h1>
                <img src="/qr.png" alt="QR Code" class="mx-auto mb-6 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5">
                <div class="space-y-4">
                    <button class="bg-yellow-700 text-white py-2 px-4 rounded w-full">Accéder à Mon Dashboard</button>
                    <button class="bg-yellow-700 text-white py-2 px-4 rounded w-full">Obtenir ma Carte Cybcraft</button>
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
    
    <div class="flex bg-black items-center justify-center h-64 w-full">
        <div class="py-4 px-6">
            <img src="logo.png" alt="Logo" class="mx-auto h-16 sm:h-20 md:h-24 lg:h-32 xl:h-40">
        </div>
    </div>
    <script>
        // Récupérer le lien généré par Laravel
        var profileLink = '{{ Route("profil.compte", ["user" => $user]) }}';

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
