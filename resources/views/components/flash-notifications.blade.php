@if (session('success'))
    <div 
        class="mt-4 p-4 bg-gradient-to-tr from-cyan-200 to-cyan-400 border-l-4 border-cyan-900 mb-3"
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
        class="mt-4 p-4 bg-gradient-to-tr from-cyan-200 to-cyan-400 border-l-4 text-red-500 border-cyan-900 mb-3"
        x-data="{ show: true }"
        x-show="show"
        x-transition
        x-init="setTimeout(() => show = false, 4000)"
    >
        {{ session('error') }}
    </div>    
@endif