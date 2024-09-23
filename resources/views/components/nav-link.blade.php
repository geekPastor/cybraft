@props(['text'])
<a {{ $attributes->merge(['class' => 'flex items-center mb-1 p-2 text-white border hover:border-none rounded-lg hover:bg-blue-700']) }} wire:navigate>
    {{ $slot }}
    <span class="ms-3">{{ $text }}</span>
</a>
