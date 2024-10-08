<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="flex">
        <!-- Barre de navigation verticale -->
        <nav class="bg-blue-600 w-64 h-screen p-6 text-white">
            <ul>
                <li class="mb-4">
                    <button class="dashboard-link font-semibold w-full text-left" data-target="section-dashboard">Dashboard</button>
                </li>
                <li class="mb-4">
                    <button class="dashboard-link font-semibold w-full text-left" data-target="section-create-user">Créer un utilisateur</button>
                </li>
                <li class="mb-4">
                    <button class="dashboard-link font-semibold w-full text-left" data-target="section-users-list">Liste des utilisateurs</button>
                </li>
            </ul>
        </nav>
    
        <!-- Contenu principal -->
        <div class="flex-1 p-6 bg-gray-100">

    
            <!-- Section Création d'utilisateur -->
            <div id="section-create-user" class="dashboard-section">
                <h2 class="text-3xl font-semibold text-blue-600 mb-4">Créer un utilisateur</h2>
                <form action="{{Route('profil.create',$user->getRouteKey()) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                        <input type="email" name="email" placeholder="Saisissez l'email" required
                            class="mt-2 block w-full border border-blue-300 rounded-lg shadow-sm py-2 px-4 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-600">Mot de passe</label>
                        <input type="password" name="password" placeholder="Saisissez le mot de passe" required
                            class="mt-2 block w-full border border-blue-300 rounded-lg shadow-sm py-2 px-4 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <div class="mb-6">
                        <label for="nom" class="block text-sm font-medium text-gray-600">Nom de l'utilisateur</label>
                        <input type="text" name="name" placeholder="Saisissez le nom" required
                            class="mt-2 block w-full border border-blue-300 rounded-lg shadow-sm py-2 px-4 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>
                    <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md mt-4"
                        type="submit">Créer l'utilisateur</button>
                </form>
            </div>
    
            <!-- Section Liste des utilisateurs -->
            <div id="section-users-list" class="dashboard-section hidden">
                <h2 class="text-2xl font-semibold mb-6 text-blue-600">Liste des utilisateurs</h2>
                <table class="min-w-full bg-white border border-blue-200 rounded-lg">
                    <thead class="bg-blue-600 text-white rounded-t-lg">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium">Nom</th>
                            <th class="px-6 py-3 text-left font-medium">Email</th>
                            <th class="px-6 py-3 text-center font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr class="border-t border-blue-100 hover:bg-blue-50">
                            <td class="px-6 py-4 text-gray-800">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-center">
                                <form action={{ Route('profil.destroy', $user) }} method="POST"
                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded-lg shadow">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-blue-100 text-gray-800 font-semibold">
                            <td class="px-6 py-4 text-right" colspan="2">Total des utilisateurs</td>
                            <td class="px-6 py-4 text-center">{{ $total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // On récupère tous les boutons de la barre de navigation
        const dashboardLinks = document.querySelectorAll('.dashboard-link');
    
        // Fonction pour afficher la section liée à l'élément cliqué
        dashboardLinks.forEach(link => {
            link.addEventListener('click', () => {
                const target = link.getAttribute('data-target');
                
                // Cacher toutes les sections
                document.querySelectorAll('.dashboard-section').forEach(section => {
                    section.classList.add('hidden');
                });
    
                // Afficher la section ciblée
                document.getElementById(target).classList.remove('hidden');
            });
        });
    </script>    
</body>
</html>    