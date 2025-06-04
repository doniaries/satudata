<div class="container mx-auto p-4">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($organizations as $org)
            <div class="bg-white shadow-lg rounded-lg p-6 card border border-gray-200">
                <h2 class="text-xl font-bold mb-2 transition duration-200 ease-in-out hover:text-blue-600 hover:scale-105 cursor-pointer">{{ $org->name }}</h2>
                <p class="text-gray-700 mb-4">{{ $org->alamat ?? '-' }}</p>
                <div class="flex flex-wrap gap-4 text-gray-600 text-sm mt-2">
                    @if ($org->nomor_telepon)
                        <span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm0 14a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5a2 2 0 00-2 2v2zm14-14a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5a2 2 0 012-2h2zm0 14a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2h-2a2 2 0 00-2 2v2z"/></svg>{{ $org->nomor_telepon }}</span>
                    @endif
                    @if ($org->email_organisasi)
                        <span class="flex items-center"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a4 4 0 01-8 0m8 0a4 4 0 00-8 0"/></svg>{{ $org->email_organisasi }}</span>
                    @endif
                    @if ($org->facebook)
                        <a href="{{ $org->facebook }}" target="_blank" class="flex items-center hover:text-blue-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.326 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/></svg>Facebook</a>
                    @endif
                    @if ($org->website_organisasi)
                        <a href="{{ $org->website_organisasi }}" target="_blank" class="flex items-center hover:text-blue-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9zm0 0v18m0-18C6.48 3 2 7.48 2 13c0 5.52 4.48 10 10 10s10-4.48 10-10c0-5.52-4.48-10-10-10z"/></svg>Website</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada data organisasi.</div>
            </div>
        @endforelse
    </div>
    <div class="mt-6 flex justify-center">
        {{ $organizations->links() }}
    </div>
</div>
