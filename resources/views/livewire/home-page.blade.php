<div class="flex flex-col font-roboto">
    <section class="w-full pt-2 md:pt-6 bg-no-repeat bg-cover bg-center"
        style="background-image: url('{{ asset('images/bg-vector.png') }}');">
        <div class="container mx-auto px-8 lg:flex items-center">
            <!-- Left Column: Content and Search -->
            <div class="lg:w-1/2 flex flex-col justify-center">
                <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold leading-tight text-center lg:text-left">
                    <div><span class="text-blue-800 font-bold">Satu</span> <span
                            class="text-blue-600 font-bold">Data</span></div>
                    <div class="text-white-600">Kabupaten Sijunjung</div>
                </h1>
                <p class="text-xl lg:text-2xl mt-6 font-light max-w-2xl text-center lg:text-left">Sistem Informasi
                    Terintegrasi dan Terpadu<br>Kabupaten Sijunjung</p>
                <div class="mt-8 md:mt-12 max-w-2xl mx-auto lg:mx-0">
                    <form action="{{ route('search') }}" method="GET"
                        class="flex items-center bg-white rounded-lg shadow-md overflow-hidden">
                        <input type="text" name="q" placeholder="Cari data..."
                            class="flex-grow px-6 py-4 focus:outline-none text-gray-700 border border-gray-300 focus:border-blue-500"
                            required>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-4 transition-colors duration-200 shadow-lg border border-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Right Column: Combined Image (Bigger, No Box) -->
            <div class="lg:w-1/2 flex justify-center lg:justify-end items-center">
                <div class="w-full max-w-3xl flex items-center justify-center">
                    <img src="{{ asset('images/bupatiwakil.png') }}" alt="Bupati dan Wakil Bupati Sijunjung"
                        class="w-full h-auto max-h-[500px] object-contain animate-slide-in-right"
                        style="animation: slideInRight 0.8s ease-out forwards;">
                </div>
            </div>
        </div>
    </section>
</div>
