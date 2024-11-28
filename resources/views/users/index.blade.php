<x-app-layout title="Utilisateurs" pageLink="{{ route('users.create') }}" pageText="Ajouter un utilisateur">
 
    <div class="relative overflow-x-auto shadow-md bg-white sm:rounded-lg mb-6">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white border-b-2 border-sky-800 uppercase bg-blue-900">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        *
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nom complet
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Mot de passe
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)                           
                    <tr class="border-b text-black hover:bg-gray-100">
                        <th class="px-6 py-4">
                            {{ $loop->iteration }}
                        </th>
                        <td class="px-6 py-4 font-medium whitespace-nowrap">
                            {{ $user->name }}
                        </td>
                        <td class="px-4 py-4">
                            {{ $user->role->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->mdp }}
                        </td>
                        <td class="px-6 py-4 text-right flex">
                            <x-primary-link href="{{ route('users.show', $user->getRouteKey()) }}">Voir</x-primary-li>
                        
                            @if ($user->id !== Auth::id())
                                <x-secondary-link class="inline-block mx-2" href="{{ route('users.edit', $user->getRouteKey()) }}">Editer</x-primary-li>
                                <form action="{{ route('users.destroy', $user->getRouteKey()) }}" method="post" class="d-inline"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"
                                >
                                    @csrf
                                    @method('delete')
                                    <x-danger-button>Supprimer</x-danger-button>
                                </form>
                                <x-secondary-button
                                    class="inline-block mx-2"
                                    onclick="copyToClipboard('{{ route('profil.compte', $user->getRouteKey()) }}')"
                                >
                                    Lien
                                </x-secondary-button>
                            @endif
                        </td>
                    </tr>
                @endforeach                
            </tbody>
        </table>
    </div>

    {{ $users->links() }}

    <script>
        function copyToClipboard(text) {
            var input = document.createElement('input');
            input.value = text;
            document.body.appendChild(input);
            input.select();
            document.execCommand('copy');
            document.body.removeChild(input);
            alert('Lien copié dans le presse-papiers');
        }
    </script>
</x-app-layout>
