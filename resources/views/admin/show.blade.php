@extends("base")

@section("content")
<div class="bg-white p-8 rounded-lg shadow-lg max-w-xl w-full m-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Créer un utilisateur</h1>
    <form action="{{Route('profil.create',['name' => $user->name]) }}" method="POST">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" placeholder="Saisissez l'email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" placeholder="Saisissez le mot de passe" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom de l'utilisateur</label>
            <input type="text" name="name" placeholder="Saisissez le nom" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2" type="submit">Créer l'utilisateur</button>
    </form>
</div>

<!-- Tableau des utilisateurs -->
<div class="bg-white p-8 rounded-lg shadow-lg max-w-xl w-full m-8 mt-10">
    <h2 class="text-xl font-bold mb-4 text-center">Liste des utilisateurs</h2>
    <table class="min-w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="w-1/3 px-4 py-2">Nom</th>
                <th class="w-1/3 px-4 py-2">Email</th>
                <th class="w-1/3 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-gray-700">
                    <td class="border px-4 py-2">{{$user->name}}</td>
                    <td class="border px-4 py-2">{{$user->email}}</td>
                    <td class="border px-4 py-2 text-center">
                        <form action={{Route('profil.destroy',['name'=>$user->name])}} method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                            @csrf
                            
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <!-- Ligne pour afficher le total des utilisateurs -->
            <tr class="bg-gray-200 text-gray-700 font-bold">
                <td class="border px-4 py-2 text-right" colspan="2">Total des utilisateurs</td>
                <td class="border px-4 py-2 text-center">{{$total}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
