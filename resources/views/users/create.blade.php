<x-app-layout title="Ajouter un nouvel utilisateur">
    <x-form-card>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-3">
                <x-input-label for="name" :value="__('Nom complet')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>


            <div>
                <x-input-label for="role_id" :value="__('Status')" />
                <x-select-input name="role_id" id="role_id" required class="w-full">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </x-select-inp>
                <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-3 my-3">
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <x-primary-button type="submit">
                        {{ __('Enregistrer') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </x-form-card>
</x-app-layout>