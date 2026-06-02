<a {{ $attributes->merge(['type' => 'button', 'class' => 'cyb-button-secondary disabled:opacity-25']) }} wire:navigate>
    {{ $slot }}
</a>
