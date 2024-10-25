<x-app-layout title="Modifiere vos informations">
    <div class="bg-white p-8 rounded-lg shadow-lg m-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Remplissez les informations ci-dessous</h1>
        <form action={{Route("profil.modif", $user->getRouteKey())}} method="POST">
            @csrf
            <div>
                <h2 class="text-lg font-semibold">Mon Identité</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <x-input-label for="nom" class="block text-sm font-medium text-gray-700">Nom</x-input-label>
                        <x-text-input type="text" name="name" id="nom" required class="block mt-1 w-full" value="{{ old('name', $user->name) }}"/>
                    </div>
                    <div>
                        <x-input-label for="profession" class="block text-sm font-medium text-gray-700">Profession</x-input-label>
                        <x-text-input type="text" name="profession" id="profession" required class="block mt-1 w-full" value="{{ old('profession', $user->profil?->profession) }}"/>
                    </div>
                    <div>
                        <x-input-label for="sexe">Sexe</x-input-label>
                        <x-select-input id="sexe" name="sexe">
                            <option value="H" @selected(old('sexe', $user->profil?->sexe) == "H")>Homme</option>
                            <option value="F" @selected(old('sexe', $user->profil?->sexe) == "F")>Femme</option>
                        </x-select-input>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-semibold">À Propos de Moi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <x-input-label for="number">Telephone</x-input-label>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="number" :value="old('number', $user->profil?->number)" required autofocus autocomplete="number" />
                    </div>
                    <div>
                        <x-input-label for="email" class="block text-sm font-medium text-gray-700">Adresse Mail</x-input-label>
                        <x-text-input type="email" name="email" id="email" required class="block mt-1 w-full" value="{{ $user->email }}"/>
                    </div>
                    <div>
                        <x-input-label for="naissance" class="block text-sm font-medium text-gray-700">Date de Naissance</x-input-label>
                        <x-text-input type="date" name='naissance' id="naissance" required class="block mt-1 w-full" value="{{ old('naissance', $user->profil?->naissance) }}"/>
                    </div>
                    <div>
                        <x-input-label for="domicile" class="block text-sm font-medium text-gray-700">Adresse Domicile</x-input-label>
                        <x-text-input type="text" name='domicile' id="domicile" class="block mt-1 w-full" value="{{ old('domicile', $user->profil?->domicile) }}"/>
                    </div>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-semibold">En savoir plus</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <x-input-label for="description" class="block text-sm font-medium text-gray-700">Description</x-input-label>
                        <x-textarea name='description' id="description" rows="3" class="block mt-1 w-full">{{$user->profil?->bio}}</x-textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="competences" class="block text-sm font-medium text-gray-700">Compétences</x-input-label>
                        <x-textarea name='competences' id="competences" rows="3" class="block mt-1 w-full" >{{$user->profil?->competences}}</x-textarea>
                        <x-input-error :messages="$errors->get('competences')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-semibold">Liaison Réseaux Sociaux</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <x-input-label for="facebook" class="block text-sm font-medium text-gray-700">Facebook</x-input-label>
                        <x-text-input type="text" name="facebook" id="facebook" class="block mt-1 w-full" value="{{ $user->profil?->reseau->facebook }}"/>
                    </div>
                    <div>
                        <x-input-label for="twitter" class="block text-sm font-medium text-gray-700">Twitter</x-input-label>
                        <x-text-input type="text" name="twitter" id="twitter" class="block mt-1 w-full" value="{{ $user->profil?->reseau->twitter }}"/>
                    </div>
                    <div>
                        <x-input-label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</x-input-label>
                        <x-text-input type="text" name="instagram" id="instagram" class="block mt-1 w-full" value="{{ $user->profil?->reseau->instagram }}"/>
                    </div>
                    <div>
                        <x-input-label for="linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</x-input-label>
                        <x-text-input type="text" name="linkedin" id="linkedin" class="block mt-1 w-full" value="{{ $user->profil?->reseau->linkedin }}"/>
                    </div>
                    <div>
                        <x-input-label for="tiktok" class="block text-sm font-medium text-gray-700">TikTok</x-input-label>
                        <x-text-input type="text" name="tiktok" id="tiktok" class="block mt-1 w-full" value="{{ $user->profil?->reseau->tiktok }}"/>
                    </div>
                    <div>
                        <x-input-label for="theads" class="block text-sm font-medium text-gray-700">Theads</x-input-label>
                        <x-text-input type="text" name="theads" id="theads" class="block mt-1 w-full" value="{{ $user->profil?->reseau->theads }}"/>
                    </div>
                    <div>
                        <x-input-label for="telegram" class="block text-sm font-medium text-gray-700">Telegram</x-input-label>
                        <x-text-input type="text" name="telegram" id="telegram" class="block mt-1 w-full" value="{{ $user->profil?->reseau->telegram }}"/>
                    </div>
                    <div>
                        <x-input-label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</x-input-label>
                        <x-text-input type="text" name="whatsapp" id="whatsapp" class="block mt-1 w-full" value="{{ $user->profil?->reseau->whatsapp }}"/>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <x-primary-button type="submit">Mettre à jour</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
