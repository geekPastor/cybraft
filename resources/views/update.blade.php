<x-app-layout title="Modifiere vos informations">
    <div class="bg-white p-8 rounded-lg shadow-lg m-8">
        <h1 class="text-2xl font-bold mb-6 text-center">Remplissez les informations ci-dessous</h1>
        <form action={{Route("profil.modif", $user->getRouteKey())}} method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <h2 class="text-lg font-semibold">Mon Identité</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                    <div>
                        <x-input-label for="nom" class="block text-sm font-medium text-gray-700">Nom</x-input-label>
                        <x-text-input type="text" name="name" id="nom" required class="block mt-1 w-full" value="{{ old('name', $user->name) }}"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="profession" class="block text-sm font-medium text-gray-700">Profession</x-input-label>
                        <x-text-input type="text" name="profession" id="profession" required class="block mt-1 w-full" value="{{ old('profession', $user->profil?->profession) }}"/>
                        <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="sexe">Sexe</x-input-label>
                        <x-select-input id="sexe" name="sexe">
                            <option value="H" @selected(old('sexe', $user->profil?->sexe) == "H")>Homme</option>
                            <option value="F" @selected(old('sexe', $user->profil?->sexe) == "F")>Femme</option>
                        </x-select-input>
                        <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-semibold">À Propos de Moi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-2">
                    <div>
                        <x-input-label for="number">Numéro téléphone</x-input-label>
                        <x-text-input id="number" class="block mt-1 w-full" type="text" name="number" :value="old('number', $user->profil?->number)" required autofocus autocomplete="number" />
                        <x-input-error :messages="$errors->get('number')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="number2">Deuxième numéro téléphone</x-input-label>
                        <x-text-input id="number2" class="block mt-1 w-full" type="text" name="number2" :value="old('number2', $user->profil?->number2)" required autofocus autocomplete="number2" />
                        <x-input-error :messages="$errors->get('number2')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" class="block text-sm font-medium text-gray-700">Adresse Mail</x-input-label>
                        <x-text-input type="email" name="email" id="email" required class="block mt-1 w-full" value="{{ $user->email }}"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="naissance" class="block text-sm font-medium text-gray-700">Date de Naissance</x-input-label>
                        <x-text-input type="date" name='naissance' id="naissance" required class="block mt-1 w-full" value="{{ old('naissance', $user->profil?->naissance) }}"/>
                        <x-input-error :messages="$errors->get('naissance')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="domicile" class="block text-sm font-medium text-gray-700">Adresse Domicile</x-input-label>
                        <x-text-input type="text" name='domicile' id="domicile" class="block mt-1 w-full" value="{{ old('domicile', $user->profil?->domicile) }}"/>
                        <x-input-error :messages="$errors->get('domicile')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="files" class="block text-sm font-medium text-gray-700">Ajouter une pièce jointe (Min : 10 mégas)</x-input-label>
                        <x-text-input type="file" name='files[]' id="files" class="block mt-1 w-full" multiple/>
                        <x-input-error :messages="$errors->get('files')" class="mt-2" />
                        
                        @if ($errors->has('files.*'))
                            @foreach ($errors->get('files.*') as $key => $messages)
                                <div class="text-red-500 text-sm mt-1">
                                    @foreach ($messages as $message)
                                        <p>{{ $message }}</p>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
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
                        <x-text-input type="text" name="facebook" id="facebook" class="block mt-1 w-full" value="{{ old('facebook',$user->profil?->reseau->facebook ?? 'https://') }}"/>
                        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="twitter" class="block text-sm font-medium text-gray-700">Twitter</x-input-label>
                        <x-text-input type="text" name="twitter" id="twitter" class="block mt-1 w-full" value="{{ old('twitter',$user->profil?->reseau->twitter ?? 'https://') }}"/>
                        <x-input-error :messages="$errors->get('twitter')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="instagram" class="block text-sm font-medium text-gray-700">Instagram</x-input-label>
                        <x-text-input type="text" name="instagram" id="instagram" class="block mt-1 w-full" value="{{ old('instagram',$user->profil?->reseau->instagram ?? 'https://') }}"/>
                        <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</x-input-label>
                        <x-text-input type="text" name="linkedin" id="linkedin" class="block mt-1 w-full" value="{{ old('linkedin', $user->profil?->reseau->linkedin ?? 'https://') }}"/>
                        <x-input-error :messages="$errors->get('linkedin')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="tiktok" class="block text-sm font-medium text-gray-700">TikTok</x-input-label>
                        <x-text-input type="text" name="tiktok" id="tiktok" class="block mt-1 w-full" value="{{ old('tiktok',$user->profil?->reseau->tiktok ?? 'https://') }}"/>
                        <x-input-error :messages="$errors->get('tiktok')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="theads" class="block text-sm font-medium text-gray-700">Theads</x-input-label>
                        <x-text-input type="text" name="theads" id="theads" class="block mt-1 w-full" value="{{ old('theads',$user->profil?->reseau->theads ?? 'https://') }}"/>
                        <x-input-error :messages="$errors->get('theads')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="telegram" class="block text-sm font-medium text-gray-700">Telegram</x-input-label>
                        <x-text-input type="text" name="telegram" id="telegram" class="block mt-1 w-full" value="{{ old('telegram',$user->profil?->reseau->telegram ?? 'https://') }}"/>
                        <x-input-error :messages="$errors->get('telegram')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="whatsapp" class="block text-sm font-medium text-gray-700">WhatsApp</x-input-label>
                        <x-text-input type="text" name="whatsapp" id="whatsapp" class="block mt-1 w-full" value="{{ old('whatsapp',$user->profil?->reseau->whatsapp ?? 'https://') }}"/>
                        <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <x-primary-button type="submit">Mettre à jour</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
