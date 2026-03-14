<div class="relative bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">

    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-slate-500">{{ $title }}</p>
            <h3 class="text-2xl font-bold text-slate-800 mt-1">
                {{ $value }}
            </h3>
        </div>

        <div class="w-12 h-12 flex items-center justify-center rounded-xl {{ $color }} text-white text-lg shadow-md">
            {{ $icon }}
        </div>
    </div>

</div>