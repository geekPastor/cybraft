<div {{ $attributes->merge(['class' => "flex justify-center"]) }}>
    <div class="shadow-lg bg-white rounded-lg p-3 w-full sm:w-3/4">
        {{ $slot }}
    </div>
</div>