@props([
    'title',
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'flex min-h-64 items-center justify-center rounded-lg border border-dashed border-black/15 bg-white/45 p-8 text-center dark:border-white/15 dark:bg-white/[0.03]']) }}>
    <div class="max-w-sm">
        <div class="mx-auto grid size-12 place-items-center rounded-full bg-cyb-gold/10 text-cyb-gold">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l2.5 2.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>
        <h2 class="mt-4 text-xl font-semibold text-cyb-ink dark:text-white">{{ $title }}</h2>
        @if ($description)
            <p class="mt-2 text-sm leading-6 text-neutral-500 dark:text-neutral-400">{{ $description }}</p>
        @endif
        @if (trim($slot) !== '')
            <div class="mt-5">
                {{ $slot }}
            </div>
        @endif
    </div>
</div>
