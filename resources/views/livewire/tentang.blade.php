<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @php
    $bgColors = [
        'bg-red-500', 'bg-blue-500', 'bg-green-500', 'bg-yellow-500',
        'bg-pink-500', 'bg-purple-500', 'bg-indigo-500', 'bg-teal-500', 'bg-orange-500'
    ];
    $textColors = [
        'text-white', 'text-white', 'text-white', 'text-black',
        'text-white', 'text-white', 'text-white', 'text-black', 'text-black'
    ];
@endphp
        @foreach($tentangs as $tentang)
            @php
                $bg = $bgColors[$loop->index % count($bgColors)];
                $text = $textColors[$loop->index % count($textColors)];
            @endphp
            <div class="shadow-lg rounded-lg p-6 card border border-gray-200 {{ $bg }} transition-transform transition-shadow duration-300 ease-in-out hover:scale-105 hover:shadow-2xl">
                <h2 class="text-xl font-bold mb-2 {{ $text }}">{{ $tentang->judul }}</h2>
                <p class="{{ $text }}">{{ $tentang->deskripsi }}</p>
            </div>
        @endforeach
    </div>
</div>
