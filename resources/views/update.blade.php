@extends("base")
@section("content")

<div class="bg-white p-8 rounded-lg shadow-lg max-w-xl w-full m-8">
    <h1 class="text-2xl font-bold mb-6 text-center">Remplissez les informations ci-dessous</h1>
    <form action={{Route("profil.modif", $user)}} method="POST">
        @csrf
        <div>
            <h2 class="text-lg font-semibold">Mon Identité</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name='name' id="nom" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->name}}>
                </div>
                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" name='prenom' id="prenom" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->prenom}}>
                </div>
                <div>
                    <label for="profession" class="block text-sm font-medium text-gray-700">Profession</label>
                    <input type="text" name='profession' id="profession" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->profession}}>
                </div>
                <div>
                    <label for="sexe" class="block text-sm font-medium text-gray-700">Sexe</label>
                    <input type="text" name='sexe' id="sexe" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->sexe}}>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-lg font-semibold">À Propos de Moi</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                <div>
                    <label for="number" class="block text-sm font-medium text-gray-700">Telephone</label>
                    <input type="text" name='number' id="number" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->number}}>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Adresse Mail</label>
                    <input type="text" name="email" id="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->email}}>
                </div>
                <div>
                    <label for="naissance" class="block text-sm font-medium text-gray-700">Date de Naissance</label>
                    <input type="date" name='naissance' id="naissance" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->naissance}}>
                </div>
                <div>
                    <label for="domicile" class="block text-sm font-medium text-gray-700">Adresse Domicile</label>
                    <input type="text" name='domicile' id="domicile" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->domicile}}>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-lg font-semibold">En savoir plus</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name='description' id="description" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{$user->profil->bio}}</textarea>
                </div>
                <div>
                    <label for="competences" class="block text-sm font-medium text-gray-700">Compétences</label>
                    <textarea name='competences' id="competences" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >{{$user->profil->competences}}</textarea>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-lg font-semibold">Entité Liée</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                <div>
                    <label for="nom_entite" class="block text-sm font-medium text-gray-700">Nom de l'Entité</label>
                    <input type="text" name='nom_entite' id="nom_entite" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->nom_entite}}>
                </div>
                <div>
                    <label for="services" class="block text-sm font-medium text-gray-700">Services</label>
                    <input type="text" name='services' id="services" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->services}}>
                </div>
                <div>
                    <label for="description_entite" class="block text-sm font-medium text-gray-700">Description de l’entité</label>
                    <textarea name="description_entite" id="description_entite" rows="3" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{$user->profil->description_entite}}</textarea>
                </div>
            </div>
        </div>
        <div>
            @php
            $tiktok="Tik Tok"
            @endphp
            <h2 class="text-lg font-semibold">Liaison Réseaux Sociaux</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                <div>
                    <label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</label>
                    <input type="text" name="facebook" id="facebook" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->reseau->facebook}}>
                </div>
                <div>
                    <label for="twitter" class="block text-sm font-medium text-gray-700">Twitter</label>
                    <input type="text" name="twitter" id="twitter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->reseau->twitter}}>
                </div>
                <div>
                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                    <input type="text" name="instagram" id="instagram" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->reseau->instagram}}>
                </div>
                <div>
                    <label for="linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                    <input type="text" name="linkedin" id="linkedin" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->reseau->linkedin}}>
                </div>
                <div>
                    <label for="tiktok" class="block text-sm font-medium text-gray-700">TikTok</label>
                    <input type="text" name="tiktok" id="tiktok" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->reseau->tiktok}}>
                </div>
                <div>
                    <label for="theads" class="block text-sm font-medium text-gray-700">Theads</label>
                    <input type="text" name="theads" id="theads" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->reseau->theads}}>
                </div>
                <div>
                    <label for="telegram" class="block text-sm font-medium text-gray-700">Telegram</label>
                    <input type="text" name="telegram" id="telegram" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->reseau->telegram}}>
                </div>
                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value={{$user->profil->reseau->whatsapp}}>
                </div>
            </div>
        </div>
        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mettre à jour</button>
        </div>
    </form>
</div>

@endsection
