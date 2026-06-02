@if (session('success'))
    <div 
        class="mb-3 mt-4 rounded-md border border-cyb-gold/30 bg-cyb-gold/10 p-4 text-cyb-ink dark:text-neutral-100"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
    >
        {{ session('success') }}
    </div>    
@endif

@if (session('error'))
    <div 
        class="mb-3 mt-4 rounded-md border border-red-500/30 bg-red-500/10 p-4 text-red-600 dark:text-red-300"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
    >
        {{ session('error') }}
    </div>    
@endif
