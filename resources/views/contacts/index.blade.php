<x-app-layout title="Contacts">
    @if ($contacts->isEmpty())
        <div class="flex items-center justify-center h-96">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900">Aucun contact</h2>
                <p class="mt-4 text-lg text-gray-500">Vous n'avez pas encore de contact.</p>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach ($contacts as $contact)
                <div class="bg-white p-3">
                    <h1>
                        <span class="font-bold">Nom : </span>{{ $contact->name }}
                    </h1>
                    <h2>
                        <span class="font-bold">Email : </span>{{ $contact->email }}
                    </h2>
                    <h2>
                        <span class="font-bold">Téléphone : </span>{{ $contact->phone }}
                    </h2>
                    <h2>
                        <span class="font-bold">Adresse : </span>{{ $contact->adresse }}
                    </h2>
                    <p>
                        <span class="font-bold">Message : </span>
                        {{ $contact->notes }}
                    </p>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
