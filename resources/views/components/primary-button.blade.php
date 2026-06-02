<button {{ $attributes->merge(['type' => 'submit', 'class' => 'cyb-button-primary']) }}>
    {{ $slot }}
</button>
