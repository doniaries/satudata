<div class="container mx-auto p-4 relative">
    <!-- Loading Indicator -->
    <x-loading-indicator />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        @php
            $gradients = [
                'from-blue-100 to-purple-100',
                'from-green-100 to-teal-100',
                'from-pink-100 to-rose-100',
                'from-amber-100 to-orange-100',
                'from-emerald-100 to-cyan-100',
                'from-violet-100 to-fuchsia-100'
            ];
        @endphp
        @forelse($organizations as $index => $org)
            @php
                $gradient = $gradients[$index % count($gradients)];
            @endphp
            <div class="bg-gradient-to-br {{ $gradient }} rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-opacity-20 border-gray-200 hover:border-opacity-30">
                <h2 class="text-xl font-bold mb-3 text-gray-800 transition duration-200 ease-in-out hover:text-indigo-600 cursor-pointer">{{ $org->name }}</h2>
                <p class="text-gray-600 mb-4 leading-relaxed">{{ $org->alamat ?? '-' }}</p>
                <div class="flex flex-wrap gap-4 text-sm mt-3">
                    @if ($org->nomor_telepon)
                        <span class="flex items-center">
                            <img src="https://img.icons8.com/fluency/24/phone-disconnected.png" alt="Telepon" class="mr-1" width="20" height="20"/>
                            {{ $org->nomor_telepon }}
                        </span>
                    @endif
                    @if ($org->email_organisasi)
                        <span class="flex items-center">
                            <img src="https://img.icons8.com/fluency/24/secured-letter.png" alt="Email" class="mr-1" width="20" height="20"/>
                            {{ $org->email_organisasi }}
                        </span>
                    @endif
                    @if ($org->facebook)
                        <a href="{{ $org->facebook }}" target="_blank" class="flex items-center hover:text-blue-700"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.326 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/></svg>Facebook</a>
                    @endif
                    @if ($org->website_organisasi)
                        <a href="{{ $org->website_organisasi }}" target="_blank" class="flex items-center hover:text-blue-700">
                            <img src="https://img.icons8.com/fluency/24/domain.png" alt="Website" class="mr-1" width="20" height="20"/>
                            Website
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="bg-blue-100 text-blue-800 px-4 py-3 rounded-lg text-center">Belum ada data organisasi.</div>
            </div>
        @endforelse
    </div>
    <div class="mt-8 flex justify-center">
        {{ $organizations->links() }}
    </div>
</div>
