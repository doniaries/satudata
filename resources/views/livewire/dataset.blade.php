<div class="bg-gray-50 min-h-screen font-roboto p-6">
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="flex">
            <!-- Sidebar Organisasi, tag, format-->
            <aside class="w-64 bg-white border-r border-gray-200 p-6">
                <!-- Daftar Organisasi -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="font-bold flex items-center gap-2 text-gray-700 text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.008v.008H6.75V6.75Zm2.25 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm13.5 0h-15v15h15V6.75Z" />
                            </svg>
                            ORGANISASI
                        </h2>
                        @if($selectedOrganization || $searchOrg)
                            <button wire:click="clearFilters" 
                                class="text-xs text-blue-600 hover:underline flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" 
                                    stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reset
                            </button>
                        @endif
                    </div>
                    
                    <!-- Pencarian Organisasi -->
                    <div class="relative mb-3">
                        <input type="text" 
                            wire:model.live="searchOrg" 
                            placeholder="Cari organisasi..." 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" />
                    </div>
                    
                    <!-- Daftar Organisasi -->
                    <div class="max-h-72 overflow-y-auto border border-gray-200 rounded-lg">
                        @forelse($organizations as $org)
                            <button 
                                wire:click="selectOrganization({{ $org->id }})"
                                class="w-full text-left p-3 flex justify-between items-center hover:bg-gray-50 transition-colors duration-150 {{ $selectedOrganization == $org->id ? 'bg-blue-50' : '' }}">
                                <span class="text-sm font-medium text-gray-700 truncate pr-2">{{ $org->name }}</span>
                                <span class="text-xs px-2 py-1 rounded-full {{ $selectedOrganization == $org->id ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $org->datasets_count }}
                                </span>
                            </button>
                        @empty
                            <div class="p-3 text-sm text-gray-500 text-center">Tidak ada organisasi ditemukan</div>
                        @endforelse
                    </div>
                </div>

                <!-- Daftar Tag -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="font-bold flex items-center gap-2 text-gray-700 text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                            TAG
                        </h2>
                        @if($selectedTag || $searchTag)
                            <button wire:click="clearFilters" 
                                class="text-xs text-blue-600 hover:underline flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" 
                                    stroke="currentColor" class="w-3.5 h-3.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Reset
                            </button>
                        @endif
                    </div>
                    
                    <!-- Pencarian Tag -->
                    <div class="relative mb-3">
                        <input type="text" 
                            wire:model.live="searchTag" 
                            placeholder="Cari tag..." 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" />
                    </div>
                    
                    <!-- Daftar Tag -->
                    <div class="flex flex-wrap gap-2 max-h-60 overflow-y-auto p-1">
                        @forelse($tags as $tag)
                            <button 
                                wire:click="selectTag({{ $tag->id }})"
                                class="px-3 py-1.5 text-sm rounded-full transition-all duration-200 flex items-center gap-1.5
                                    {{ $selectedTag == $tag->id 
                                        ? 'bg-blue-600 text-white shadow-md' 
                                        : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                                <span>{{ $tag->name }}</span>
                                <span class="text-xs px-1.5 py-0.5 rounded-full {{ $selectedTag == $tag->id ? 'bg-white/20' : 'bg-gray-200/70' }}">
                                    {{ $tag->datasets_count }}
                                </span>
                            </button>
                        @empty
                            <div class="w-full p-2 text-sm text-gray-500 text-center">Tidak ada tag ditemukan</div>
                        @endforelse
                    </div>
                </div>

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
                        <div class="relative flex items-center">
                            <input type="text" 
                                placeholder="Cari dataset..." 
                                wire:model.live="search"
                                class="w-full pl-4 pr-12 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-base placeholder-gray-400" />
                            
                            <!-- Tombol Reset (X) -->
                            @if($search)
                                <button 
                                    type="button"
                                    wire:click="$set('search', '')"
                                    class="absolute right-16 mr-1 p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 active:bg-red-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span class="sr-only">Hapus pencarian</span>
                                </button>
                            @endif
                            
                            <!-- Tombol Search -->
                            <button 
                                type="submit"
                                class="absolute right-2 p-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50 transition-all duration-200 transform hover:scale-105 active:scale-95 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                                <span class="sr-only">Cari</span>
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
                                class="flex items-start gap-4 p-5 border border-gray-200 rounded-lg hover:shadow-md transition-all duration-200 bg-white">
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
                                                        d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 1 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
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
