<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($tentangs as $tentang)
            <div class="bg-white shadow-lg rounded-lg p-6 card border border-gray-200">
                <h2 class="text-xl font-bold mb-2">{{ $tentang->judul }}</h2>
                <p class="text-gray-700">{{ $tentang->deskripsi }}</p>
            </div>
        @endforeach
    </div>
</div>
