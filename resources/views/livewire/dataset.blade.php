<div class="flex bg-gray-100 min-h-screen font-roboto">
    <!-- Sidebar Organisasi -->
    <aside class="w-64 bg-white border-r p-4">
        <h2 class="font-bold mb-2">Organisasi</h2>
        <ul class="space-y-1 text-sm">
            @foreach($organizations as $org)
                <li class="flex justify-between items-center rounded transition cursor-pointer hover:bg-blue-100 hover:shadow-sm group">
                    <span class="flex items-center gap-2 truncate group-hover:text-blue-700 transition" title="{{ $org->name }}">
                        <!-- Heroicon: building-office-2 -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-blue-400 flex-shrink-0 group-hover:text-blue-600 transition">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 21V5.25A2.25 2.25 0 0 1 6.75 3h10.5A2.25 2.25 0 0 1 19.5 5.25V21m-15 0v-2.25A2.25 2.25 0 0 1 6.75 16.5h10.5a2.25 2.25 0 0 1 2.25 2.25V21M9 7.5h6m-6 3h6m-6 3h6" />
                        </svg>
                        {{ $org->name }}
                    </span>
                    <span class="ml-2 rounded-full px-2 text-xs font-semibold {{ $org->datasets_count < 10 ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                        {{ $org->datasets_count }}
                    </span>
                </li>
            @endforeach
        </ul>
        <div class="mt-2 text-xs font-semibold text-blue-600 cursor-pointer">Show More Organisasi</div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <!-- Search & Order -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <form wire:submit.prevent="" class="flex-1 mr-2">
                <input type="text" wire:model.defer="search" placeholder="Search datasets..." class="w-full border rounded-lg px-4 py-2" />
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

        <!-- List Dataset -->
        <div class="space-y-8">
            @forelse($datasets as $dataset)
                <div class="border-b pb-4">
                    <div class="font-bold text-lg">{{ $dataset->judul }}</div>
                    <div class="text-sm text-gray-500 mb-2">
                        {{ $dataset->organization->name ?? '-' }}
                    </div>
                    <div class="text-sm italic text-red-500 mb-2">
                        {{ $dataset->deskripsi_dataset ? Str::limit($dataset->deskripsi_dataset, 80) : 'This dataset has no description' }}
                    </div>
                    <a href="#" class="inline-block bg-red-600 text-white text-xs px-3 py-1 rounded font-bold">PDF</a>
                </div>
            @empty
                <div class="text-gray-500">No dataset found.</div>
            @endforelse
        </div>
        <div class="mt-6">
            {{ $datasets->links() }}
        </div>
    </main>
</div>
