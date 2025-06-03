<header x-data="{
    scrolled: false,
    init() {
        this.$watch('scrolled', (value) => {
            const header = this.$el;
            if (value) {
                header.classList.remove('bg-white', 'shadow-lg');
                header.classList.add('bg-white/80', 'backdrop-blur-sm');
            } else {
                header.classList.add('bg-white', 'shadow-lg');
                header.classList.remove('bg-white/80', 'backdrop-blur-sm');
            }
        });
        window.addEventListener('scroll', () => {
            this.scrolled = window.scrollY > 10;
        });
    }
}" :class="{ 'bg-white shadow-lg': !scrolled, 'bg-white/80 backdrop-blur-sm': scrolled }"
    class="sticky top-0 z-50 transition-all duration-300">
    <nav class="container mx-auto px-4 lg:px-6 py-2.5">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('images/kabupaten-sijunjung.png') }}" class="h-10 sm:h-12"
                    alt="Logo Kabupaten Sijunjung" />
                <div class="flex flex-col">
                    <div class="flex items-center space-x-1">
                        <span class="text-lg font-bold text-blue-800">Satu</span>
                        <span class="text-lg font-bold text-blue-400">Data</span>
                    </div>
                    <span class="text-sm font-medium text-gray-600 dark:text-gray-800 transition-colors duration-300"
                        :class="{ 'text-white/90': scrolled, 'text-gray-600': !scrolled }">Kabupaten Sijunjung</span>
                </div>
            </a>
            <div class="flex items-center lg:order-2">
                <a href="/login"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none transition-colors duration-200">
                    Log in
                </a>
                <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-2 lg:mt-0">
                    <li>
                        <a href="/" class="block py-2 px-4 rounded-lg transition-colors duration-200"
                            :class="$el.closest('li').classList.contains('active') || $el.getAttribute('href') === window
                                .location.pathname ?
                                'text-white bg-blue-600 hover:bg-blue-700' :
                                (scrolled ?
                                    'text-white/90 hover:bg-white/20' :
                                    'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700')
                            }"
                            aria-current="page">Beranda</a>
                    </li>
                    <li>
                        <a href="/dataset" class="block py-2 px-4 rounded-lg transition-colors duration-200"
                            :class="$el.closest('li').classList.contains('active') || $el.getAttribute('href') === window
                                .location.pathname ?
                                'text-white bg-blue-600 hover:bg-blue-700' :
                                (scrolled ?
                                    'text-white/90 hover:bg-white/20' :
                                    'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700')
                            }">Data</a>
                    </li>
                    <li>
                        <a href="/organisasi" class="block py-2 px-4 rounded-lg transition-colors duration-200"
                            :class="$el.closest('li').classList.contains('active') || $el.getAttribute('href') === window
                                .location.pathname ?
                                'text-white bg-blue-600 hover:bg-blue-700' :
                                (scrolled ?
                                    'text-white/90 hover:bg-white/20' :
                                    'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700')
                            }">Organisasi</a>
                    </li>
                    <li>
                        <a href="/tentang" class="block py-2 px-4 rounded-lg transition-colors duration-200"
                            :class="$el.closest('li').classList.contains('active') || $el.getAttribute('href') === window
                                .location.pathname ?
                                'text-white bg-blue-600 hover:bg-blue-700' :
                                (scrolled ?
                                    'text-white/90 hover:bg-white/20' :
                                    'text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700')
                            }">Tentang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
