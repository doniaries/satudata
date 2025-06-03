<div class="flex bg-gray-100 min-h-screen font-roboto">
    <!-- Sidebar Organisasi -->
    <aside class="w-64 bg-white border-r p-4">
        <h2 class="font-bold mb-2">Organisasi</h2>
        <ul class="space-y-1 text-sm">
            @foreach($organizations as $org)
                <li class="flex justify-between items-center">
                    <span class="truncate" title="{{ $org->name }}">{{ $org->name }}</span>
                    <span class="ml-2 bg-gray-200 rounded-full px-2 text-xs">{{ $org->datasets_count }}</span>
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
