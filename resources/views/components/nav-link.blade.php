@props(['text'])
<a {{ $attributes->merge(['class' => 'flex items-center mb-2 p-2 text-white bg-gray-700 hover:border-none rounded-lg hover:bg-blue-700']) }} wire:navigate>
    {{ $slot }}
    <span class="ms-3">{{ $text }}</span>
</a>
