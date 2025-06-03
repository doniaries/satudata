<div class="bg-gray-50 min-h-screen font-roboto p-6">
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="flex">
            <!-- Sidebar Organisasi, tag, format-->
            <aside class="w-64 bg-white border-r border-gray-200 p-6">
                <h2 class="font-bold mb-4 flex items-center gap-2 text-gray-700 text-base">
                    <!-- Heroicon: tag -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>
                    Organisasi
                </h2>
                <ul class="space-y-2 text-sm mb-8">
                    @foreach ($showAllOrganizations ? $organizations : $organizations->take(10) as $org)
                        <li
                            class="flex justify-between items-center rounded-lg p-2 transition cursor-pointer hover:bg-blue-50 hover:shadow-sm group">
                            <span
                                class="flex items-center gap-2 truncate group-hover:text-blue-700 transition text-gray-600"
                                title="{{ $org->name }}">
                                {{ $org->name }}
                            </span>
                            <span
                                class="ml-2 rounded-full px-2 py-1 text-xs font-semibold {{ $org->datasets_count < 10 ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                                {{ $org->datasets_count }}
                            </span>
                        </li>
                    @endforeach
                </ul>
                @if ($organizations->count() > 10)
                    <div class="mb-6 text-xs font-semibold text-blue-600 cursor-pointer hover:text-blue-800"
                        wire:click="$toggle('showAllOrganizations')">
                        {{ $showAllOrganizations ? 'Show Less Organisasi' : 'Show More Organisasi' }}
                    </div>
                @endif

                <h2 class="font-bold mb-4 flex items-center gap-2 text-gray-700 text-base">
                    <!-- Heroicon: tag -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    Tag
                </h2>
                <ul class="space-y-2 text-sm mb-8">
                    @foreach ($showAllTags ? $tags : $tags->take(10) as $tag)
                        <li class="flex justify-between items-center p-2 rounded-lg hover:bg-gray-50">
                            <span class="truncate text-gray-600" title="{{ $tag->name }}">{{ $tag->name }}</span>
                            <span
                                class="ml-2 bg-gray-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700">{{ $tag->datasets_count }}</span>
                        </li>
                    @endforeach
                </ul>
                @if ($tags->count() > 10)
                    <div class="mb-6 text-xs font-semibold text-blue-600 cursor-pointer hover:text-blue-800"
                        wire:click="$toggle('showAllTags')">
                        {{ $showAllTags ? 'Show Less Tag' : 'Show More Tag' }}
                    </div>
                @endif

                <h2 class="font-bold mb-4 flex items-center gap-2 text-gray-700 text-base">
                    <!-- Heroicon: document -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25A2.25 2.25 0 0 0 9 7.5h6a2.25 2.25 0 0 0 2.25-2.25V3m-12 0A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25A2.25 2.25 0 0 1 6.75 3z" />
                    </svg>
                    Formats
                </h2>
                <ul class="space-y-2 text-sm">
                    @foreach ($showAllFormats ? $formats : $formats->take(10) as $format)
                        <li class="flex justify-between items-center p-2 rounded-lg hover:bg-gray-50">
                            <span class="truncate text-gray-600"
                                title="{{ $format->format }}">{{ $format->format }}</span>
                            <span
                                class="ml-2 bg-gray-300 rounded-full px-2 py-1 text-xs font-semibold text-gray-700">{{ $format->total }}</span>
                        </li>
                    @endforeach
                </ul>
                @if ($formats->count() > 10)
                    <div class="mt-4 text-xs font-semibold text-blue-600 cursor-pointer hover:text-blue-800"
                        wire:click="$toggle('showAllFormats')">
                        {{ $showAllFormats ? 'Show Less Format' : 'Show More Format' }}
                    </div>
                @endif
            </aside>

            <!-- Main Content -->
            <main class="flex-1 bg-white">
                <!-- Header Section -->
                <div class="bg-white p-8 rounded-lg">
                    <div class="flex items-center space-x-3 mb-4">
                        <!-- Dataset Icon dari Heroicons -->
                        <div class="bg-white/20 p-3 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>

                        </div>
                        <h1 class="text-2xl font-bold text-gray-700">DATASET</h1>
                    </div>

                    <p class="text-gray-700/90 text-lg mb-6">
                        Temukan kumpulan data-data mentah (dataset) berupa tabel yang bisa diolah lebih lanjut di sini.
                    </p>

                    <!-- Search Box dengan Icon -->
                    <div class="relative max-w-5xl">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <!-- Search Icon dari Heroicons -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <input type="text" placeholder="Cari dataset"
                            class="w-full pl-12 pr-4 py-4 text-gray-700 bg-white border-0 rounded-xl shadow-lg focus:outline-none focus:ring-4 focus:ring-white/30 focus:shadow-xl transition-all duration-300 text-lg placeholder-gray-500" />
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                            <!-- Filter Icon dari Heroicons (optional) -->
                            <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="p-8">
                    <!-- Dataset Count and Order -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-lg text-gray-600">{{ number_format($totalDatasets, 0, ',', '.') }} dataset
                            ditemukan</h2>
                        <div class="flex items-center">
                            <label class="mr-2 text-sm text-gray-600">Order by:</label>
                            <select wire:model="orderBy"
                                class="border border-gray-300 rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="relevansi">Relevansi</option>
                                <option value="terbaru">Terbaru</option>
                            </select>
                        </div>
                    </div>

                    <!-- Dataset List -->
                    <div class="space-y-4">
                        @forelse ($datasets as $dataset)
                            <div
                                class="flex items-start gap-4 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                                <!-- Excel Icon -->
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-12 bg-green-600 rounded flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24"
                                            class="w-6 h-6">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                            <path d="M14 2v6h6" />
                                            <path d="M16 13a6 6 0 0 1-6 6c-3 0-6-3-6-6s3-6 6-6a6 6 0 0 1 6 6z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Dataset Info -->
                                <div class="flex-1 min-w-0">
                                    <!-- Judul Dataset -->
                                    <h3
                                        class="font-bold text-lg text-blue-600 mb-1 hover:text-blue-800 cursor-pointer">
                                        {{ $dataset->judul }}
                                    </h3>

                                    <!-- Tags - Organisasi -->
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-medium">
                                            {{ $dataset->organization->name ?? 'Unknown Organization' }}
                                        </span>

                                        <!-- Tags tambahan jika ada relasi dengan tags -->
                                        @if ($dataset->tags && $dataset->tags->count() > 0)
                                            @foreach ($dataset->tags->take(3) as $tag)
                                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                            @if ($dataset->tags->count() > 3)
                                                <span class="text-xs text-gray-500">+{{ $dataset->tags->count() - 3 }}
                                                    more</span>
                                            @endif
                                        @endif
                                    </div>

                                    <!-- Meta Info -->
                                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-2">
                                        <!-- Tanggal Rilis -->
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25A2.25 2.25 0 0 0 9 7.5h6a2.25 2.25 0 0 0 2.25-2.25V3m-12 0A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25A2.25 2.25 0 0 1 6.75 3z" />
                                            </svg>
                                            {{ $dataset->tanggal_rilis ? $dataset->tanggal_rilis->format('d M Y') : 'No date' }}
                                        </span>

                                        <!-- Nama Organisasi -->
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                            </svg>
                                            {{ $dataset->organization->name ?? 'Unknown Organization' }}
                                        </span>

                                        <!-- Frekuensi Pembaruan -->
                                        @if ($dataset->frekuensi_pembaruan)
                                            <span class="flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                                {{ $dataset->frekuensi_pembaruan }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Deskripsi Dataset -->
                                    @if ($dataset->deskripsi_dataset)
                                        <p class="text-sm text-gray-600 line-clamp-2">
                                            {{ Str::limit($dataset->deskripsi_dataset, 120) }}
                                        </p>
                                    @endif
                                </div>

                                <!-- View Count -->
                                <div class="flex-shrink-0 text-right">
                                    <div
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ number_format($dataset->jumlah_dilihat) }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        {{ $dataset->created_at ? $dataset->created_at->format('Y') : 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="text-gray-400 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>
                                </div>
                                <p class="text-gray-500">No dataset found.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $datasets->links() }}
                    </div>
                </div>
        </div>
    </div>
</div>
