@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-neutral-700 dark:text-neutral-200']) }}>
    {{ $value ?? $slot }}
</label>
