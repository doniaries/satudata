<div class="flex bg-gray-100 min-h-screen font-roboto">
    <!-- Sidebar Organisasi, tag, format-->
    <aside class="w-64 bg-white border-r p-4">
        <h2 class="font-bold mb-2">Organisasi</h2>
        <ul class="space-y-1 text-sm">
            @foreach ($showAllOrganizations ? $organizations : $organizations->take(10) as $org)
                <li
                    class="flex justify-between items-center rounded transition cursor-pointer hover:bg-blue-100 hover:shadow-sm group">
                    <span class="flex items-center gap-2 truncate group-hover:text-blue-700 transition"
                        title="{{ $org->name }}">
                        <!-- Heroicon: building-office-2 -->
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-4 h-4 text-blue-400 flex-shrink-0 group-hover:text-blue-600 transition">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 21h16.5M4.5 21V5.25A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25V21m-15 0v-2.25A2.25 2.25 0 0 1 6.75 16.5h10.5a2.25 2.25 0 0 1 2.25 2.25V21M9 7.5h6m-6 3h6m-6 3h6" />
                        </svg> --}}
                        {{ $org->name }}
                    </span>
                    <span
                        class="ml-2 rounded-full px-2 text-xs font-semibold {{ $org->datasets_count < 10 ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                        {{ $org->datasets_count }}
                    </span>
                </li>
            @endforeach
        </ul>
        @if ($organizations->count() > 10)
            <div class="mt-2 text-xs font-semibold text-blue-600 cursor-pointer"
                wire:click="$toggle('showAllOrganizations')">
                {{ $showAllOrganizations ? 'Show Less Organisasi' : 'Show More Organisasi' }}
            </div>
        @endif

        <h2 class="font-bold mb-2 flex items-center gap-2 text-gray-700 text-base">
            <!-- Heroicon: tag -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.25 12.75V6.75A2.25 2.25 0 0 1 4.5 4.5h6a2.25 2.25 0 0 1 1.59.66l8.25 8.25a2.25 2.25 0 0 1 0 3.18l-6.75 6.75a2.25 2.25 0 0 1-3.18 0l-8.25-8.25A2.25 2.25 0 0 1 2.25 12.75z" />
                <circle cx="8.25" cy="8.25" r="1.75" />
            </svg>
            Tag
        </h2>
        <ul class="space-y-1 text-sm">
            @foreach ($showAllTags ? $tags : $tags->take(10) as $tag)
                <li class="flex justify-between items-center">
                    <span class="truncate" title="{{ $tag->name }}">{{ $tag->name }}</span>
                    <span class="ml-2 bg-gray-200 rounded-full px-2 text-xs font-bold">{{ $tag->datasets_count }}</span>
                </li>
            @endforeach
        </ul>
        @if ($tags->count() > 10)
            <div class="mt-2 text-xs font-semibold text-blue-600 cursor-pointer" wire:click="$toggle('showAllTags')">
                {{ $showAllTags ? 'Show Less Tag' : 'Show More Tag' }}
            </div>
        @endif
        <h2 class="font-bold mb-2 flex items-center gap-2 text-gray-700 text-base">
            <!-- Heroicon: document -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6.75 3v2.25A2.25 2.25 0 0 0 9 7.5h6a2.25 2.25 0 0 0 2.25-2.25V3m-12 0A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25v13.5A2.25 2.25 0 0 1 17.25 21H6.75A2.25 2.25 0 0 1 4.5 18.75V5.25A2.25 2.25 0 0 1 6.75 3z" />
            </svg>
            Formats
        </h2>
        <ul class="space-y-1 text-sm">
            @foreach ($showAllFormats ? $formats : $formats->take(10) as $format)
                <li class="flex justify-between items-center">
                    <span class="truncate" title="{{ $format->format }}">{{ $format->format }}</span>
                    <span class="ml-2 bg-gray-300 rounded-full px-2 text-xs font-bold">{{ $format->total }}</span>
                </li>
            @endforeach
        </ul>
        @if ($formats->count() > 10)
            <div class="mt-2 text-xs font-semibold text-blue-600 cursor-pointer" wire:click="$toggle('showAllFormats')">
                {{ $showAllFormats ? 'Show Less Format' : 'Show More Format' }}
            </div>
        @endif
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <!-- Search & Order -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <form wire:submit.prevent="" class="flex-1 mr-2">
                <input type="text" wire:model.defer="search" placeholder="Search datasets..."
                    class="w-full border rounded-lg px-4 py-2" />
            </form>
            <div class="flex items-center mt-2 md:mt-0">
                <label class="mr-2 font-semibold">Order by:</label>
                <select wire:model="orderBy" class="border rounded px-2 py-1">
                    <option value="relevansi">Relevansi</option>
                    <option value="terbaru">Terbaru</option>
                </select>
            </div>
        </div>

        <!-- Jumlah Dataset -->
        <h2 class="text-2xl font-bold mb-2">{{ number_format($totalDatasets, 0, ',', '.') }} dataset found</h2>

        <div class="flex-1 px-4 py-8">
            <div class="max-w-4xl mx-auto">
                @forelse ($datasets as $dataset)
                    <div class="bg-white rounded-xl shadow-md mb-6 p-6 border border-gray-200">
                        <div class="font-bold text-lg mb-1">{{ $dataset->judul_dataset }}</div>
                        <div class="text-xs text-gray-500 mb-1">{{ $dataset->organization->name ?? '-' }}</div>
                        <div class="text-sm italic text-red-500 mb-2">
                            {{ $dataset->deskripsi_dataset ? Str::limit($dataset->deskripsi_dataset, 80) : 'This dataset has no description' }}
                        </div>
                        <a href="#"
                            class="inline-block bg-red-600 text-white text-xs px-3 py-1 rounded font-bold">PDF</a>
                    </div>
                @empty
                    <div class="text-gray-500">No dataset found.</div>
                @endforelse
            </div>
        </div>
        <div class="mt-6">
            {{ $datasets->links() }}
        </div>
    </main>
</div>
