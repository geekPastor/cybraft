<x-app-layout title="Mon QR Code">
    <div class="mx-auto max-w-4xl space-y-6">
        <x-app-card>
            <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-cyb-gold">Partage</p>
                    <h1 class="mt-2 text-2xl font-semibold text-cyb-ink dark:text-white">QR Code du profil</h1>
                    <p class="mt-2 text-sm text-neutral-500 dark:text-neutral-400">Utilisez ce QR code comme alternative à la carte NFC.</p>
                </div>
                <a href="{{ route('profil.compte', $user->getRouteKey()) }}" class="cyb-button-secondary w-fit">Voir le profil</a>
            </div>
        </x-app-card>

        <div class="grid gap-6 lg:grid-cols-[0.8fr_1fr]">
            <x-app-card class="text-center">
                <div class="mx-auto grid w-fit place-items-center rounded-lg border border-black/10 bg-white p-5 dark:border-white/10">
                    {!! $qrCode !!}
                </div>
                <p class="mt-5 break-all text-sm text-neutral-500 dark:text-neutral-400">{{ route('profil.compte', $user->getRouteKey()) }}</p>
            </x-app-card>

            <x-app-card>
                <h2 class="text-lg font-semibold text-cyb-ink dark:text-white">Actions</h2>
                <div class="mt-5 grid gap-3">
                    <button id="copyLinkButton" type="button" class="cyb-button-primary w-full">Copier le lien</button>
                    <a class="cyb-button-secondary w-full" href="https://wa.me/?text={{ urlencode(route('profil.compte', $user->getRouteKey())) }}" target="_blank">Partager sur WhatsApp</a>
                    <a class="cyb-button-secondary w-full" href="sms:?body={{ urlencode(route('profil.compte', $user->getRouteKey())) }}">Partager par SMS</a>
                    <a class="cyb-button-secondary w-full" href="mailto:?subject=Profil Cybcraft&body={{ urlencode(route('profil.compte', $user->getRouteKey())) }}">Partager par email</a>
                </div>
                <form class="mt-6 border-t border-black/10 pt-5 dark:border-white/10" action="{{ route('profil.supprimeDestrroy', $user->getRouteKey()) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">
                    @csrf
                    <x-danger-button class="w-full">Supprimer mon profil</x-danger-button>
                </form>
            </x-app-card>
        </div>
    </div>

    <script>
        const profileLink = '{{ route("profil.compte", $user->getRouteKey()) }}';
        document.getElementById('copyLinkButton').addEventListener('click', function() {
            navigator.clipboard.writeText(profileLink).then(() => alert('Lien copié dans le presse-papiers'));
        });
    </script>
</x-app-layout>
