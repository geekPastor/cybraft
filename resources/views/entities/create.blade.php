@isset($entity)
    @php
        $route = route('entities.update', $entity);
        $method = 'PUT';
        $title = "Modifier les informations de {$entity->name}";
    @endphp
@else
    @php
        $route = route('entities.store');
        $method = 'POST';
        $entity = null;
        $title = "Enregistrer la société";
    @endphp
@endisset
<x-app-layout :title="$title">
    
    <x-form-card>
        <div class="mb-6">
            <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Entité</p>
            <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">{{ $title }}</h1>
            <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Ces informations alimentent votre profil public et vos services.</p>
        </div>

        <form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method($method)
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <x-input-label for="name">Nom de la société</x-input-label>
                    <x-text-input type="text" required name="name" id="name" value="{{ old('name', $entity?->name) }}" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="type">Type</x-input-label>
                    <x-select-input name="entity_type_id" id="type">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}" @selected($entity?->type->id == $type->id)>{{ $type->name }}</option>
                        @endforeach
                    </x-select-input>
                    <x-input-error :messages="$errors->get('entity_type_id')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="address">Adresse</x-input-label>
                    <x-text-input name="address" id="address" required value="{{ old('address', $entity?->address) }}" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
                <div>
                    <x-input-label for="website">Site web</x-input-label>
                    <x-text-input type="text" name="website" id="website" required value="{{ old('website', $entity?->website) }}" placeholder="ex : https://google.com"/>
                    <x-input-error :messages="$errors->get('website')" class="mt-2" />
                </div>
                <div class="md:col-span-2">
                    <x-input-label for="description">Description</x-input-label>
                    <x-textarea name="description" id="description" required>{{ old('description', $entity?->description) }}</x-textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>
            <div>
                <x-input-label for="files" class="block text-sm font-medium text-gray-700">Ajouter une pièce jointe (Min : 10 mégas)</x-input-label>
                <x-text-input type="file" name='files[]' id="files" multiple/>
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
            <div class="flex justify-end border-t border-black/10 pt-5 dark:border-white/10">
                <x-primary-button type="submit">Enregistrer</x-primary-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
