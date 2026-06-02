@props(['title', 'count'])
<div {{ $attributes->merge(['class' => 'cyb-card text-sm lg:text-lg']) }}>
    <h1 class="text-sm font-medium text-neutral-500 dark:text-neutral-400">{{ $title }}</h1>
    <h2 class="mt-2 text-3xl font-semibold text-cyb-ink dark:text-neutral-100">{{ $count }}</h2>
</div>
