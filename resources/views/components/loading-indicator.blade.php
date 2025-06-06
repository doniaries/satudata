<!-- Loading Indicator Component -->
<div {{ $attributes->merge(['class' => 'fixed inset-0 z-50 flex items-center justify-center']) }} style="display: none;" wire:loading.flex>
    <div class="flex flex-col items-center">
        <div class="animate-bounce w-16 h-16">
            <img src="{{ asset('images/kabupaten-sijunjung.png') }}" 
                 alt="Logo Kabupaten Sijunjung" 
                 class="w-full h-full object-contain">
        </div>
        <span class="mt-4 text-sm font-medium text-gray-700">Memuat data...</span>
    </div>
</div>
