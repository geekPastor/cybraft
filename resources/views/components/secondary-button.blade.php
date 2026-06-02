<button {{ $attributes->merge(['type' => 'button', 'class' => 'cyb-button-secondary disabled:opacity-25']) }}>
    {{ $slot }}
</button>
