@props(['note'])

<div class="p-3 bg-white shadow-md">
    <h3 class="font-bold">{{ $note->user->name }}</h3>
    <p class="text-sm text-gray-700">{{ $note->comment }}</p>
    <p>
        Note : {{ $note->note }} / 5
    </p>
    <p class="text-xs text-gray-500">{{ $note->created_at->diffForHumans() }}</p>
</div>