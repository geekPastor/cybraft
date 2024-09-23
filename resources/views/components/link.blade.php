<a {{ $attributes->merge(['class' => 'text-blue-500 font-bold hover:underline']) }} wire:navigate>
    {{ $slot }}
</a>