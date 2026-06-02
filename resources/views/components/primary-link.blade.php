<a {{ $attributes->merge(['type' => 'submit', 'class' => 'cyb-button-primary']) }} wire:navigate>
    {{ $slot }}
</a>
