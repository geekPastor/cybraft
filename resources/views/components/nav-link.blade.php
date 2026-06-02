@props(['text'])
<a {{ $attributes->merge(['class' => 'mb-2 flex items-center rounded-md px-3 py-2 text-sm font-medium text-neutral-700 transition hover:bg-cyb-gold/10 hover:text-cyb-gold dark:text-neutral-200 dark:hover:bg-cyb-gold/15']) }} wire:navigate>
    {{ $slot }}
    <span class="ms-3">{{ $text }}</span>
</a>
