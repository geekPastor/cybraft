<div {{ $attributes->merge(['class' => "flex justify-center"]) }}>
    <div class="cyb-surface w-full rounded-lg p-5">
        {{ $slot }}
    </div>
</div>
