<header x-data="{
    scrolled: false,
    mobileMenuOpen: false,
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

        // Auto shine effect setiap 5 detik
        setInterval(() => {
            const logoContainer = this.$el.querySelector('.logo-brand-container');
            if (logoContainer) {
                logoContainer.classList.add('auto-shine');
                setTimeout(() => {
                    logoContainer.classList.remove('auto-shine');
                }, 1200);
            }
        }, 5000);
    }
}" :class="{ 'bg-white shadow-lg': !scrolled, 'bg-white/80 backdrop-blur-sm': scrolled }"
    class="sticky top-0 z-50 transition-all duration-300">

    <!-- CSS untuk efek shiny -->
    <style>
        .logo-brand-container {
            position: relative;
            overflow: hidden;
        }

        .logo-brand-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.7), transparent);
            transition: left 1.2s ease-in-out;
            z-index: 10;
            pointer-events: none;
        }

        .logo-brand-container:hover::before,
        .logo-brand-container.auto-shine::before {
            left: 100%;
        }

        .logo-image {
            position: relative;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .brand-text {
            position: relative;
        }

        .mobile-menu-enter {
            transition: all 0.3s ease-out;
            transform: translateY(-10px);
            opacity: 0;
        }

        .mobile-menu-enter-active {
            transform: translateY(0);
            opacity: 1;
        }

        .mobile-menu-exit {
            transition: all 0.3s ease-in;
            transform: translateY(0);
            opacity: 1;
        }

        .mobile-menu-exit-active {
            transform: translateY(-10px);
            opacity: 0;
        }

        /* Enhanced hover effects */
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .login-btn {
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.4s ease, height 0.4s ease;
        }

        .login-btn:hover::before {
            width: 300px;
            height: 300px;
        }
    </style>

    <nav class="font-roboto container mx-auto px-4 lg:px-6 py-3 lg:py-4">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <!-- Logo dengan efek shiny dari logo ke nama aplikasi -->
            <a href="/" class="logo-brand-container flex items-center space-x-4 py-2 px-2 rounded-xl">
                <div class="logo-image">
                    <img src="{{ asset('images/kabupaten-sijunjung.png') }}"
                        class="h-12 sm:h-14 lg:h-16 w-auto object-contain drop-shadow-md"
                        alt="Logo Kabupaten Sijunjung" />
                </div>
                <div class="brand-text flex flex-col">
                    <div class="flex items-center space-x-1">
                        <span class="text-lg lg:text-2xl font-bold text-blue-800 drop-shadow-sm">Satu</span>
                        <span class="text-lg lg:text-2xl font-bold text-blue-400 drop-shadow-sm">Data</span>
                    </div>
                    <span class="text-sm lg:text-base font-medium transition-colors duration-300"
                        :class="scrolled ? 'text-gray-700' : 'text-gray-600'">Kabupaten Sijunjung</span>
                </div>
            </a>

            <!-- Desktop menu dan tombol login -->
            <div class="flex items-center lg:order-2 space-x-3">
                <a href="/admin/login"
                    class="login-btn text-white bg-blue-600 hover:bg-green-600 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm px-4 py-2.5 focus:outline-none transition-all duration-200 flex items-center justify-center shadow-md hover:shadow-lg transform hover:scale-105 relative z-10"
                    title="Login">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 relative z-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                </a>

                <!-- Tombol hamburger -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                    class="inline-flex items-center p-2 text-sm rounded-lg lg:hidden transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    :class="scrolled ? 'text-gray-700 hover:bg-gray-300' : 'text-gray-500 hover:bg-gray-300'"
                    aria-controls="mobile-menu" :aria-expanded="mobileMenuOpen">
                    <span class="sr-only">Open main menu</span>
                    <!-- Icon hamburger -->
                    <svg class="w-6 h-6 transition-transform duration-200" :class="{ 'rotate-90': mobileMenuOpen }"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                        x-show="!mobileMenuOpen">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <!-- Icon close -->
                    <svg class="w-6 h-6 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" x-show="mobileMenuOpen">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex lg:w-auto lg:order-1" id="desktop-menu">
                <ul class="flex flex-row space-x-2 font-medium">
                    <li>
                        <a href="/"
                            class="nav-link block py-2.5 px-4 rounded-lg transition-all duration-200 hover:scale-105 relative"
                            :class="window.location.pathname === '/' ?
                                'text-white bg-blue-600 hover:bg-blue-700 shadow-md' :
                                'text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700'">Beranda</a>
                    </li>
                    <li>
                        <a href="/dataset"
                            class="nav-link block py-2.5 px-4 rounded-lg transition-all duration-200 hover:scale-105 relative"
                            :class="window.location.pathname === '/dataset' ?
                                'text-white bg-blue-600 hover:bg-blue-700 shadow-md' :
                                'text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700'">Data</a>
                    </li>
                    <li>
                        <a href="/organization"
                            class="nav-link block py-2.5 px-4 rounded-lg transition-all duration-200 hover:scale-105 relative"
                            :class="window.location.pathname === '/organization' ?
                                'text-white bg-blue-600 hover:bg-blue-700 shadow-md' :
                                'text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700'">Organisasi</a>
                    </li>
                    <li>
                        <a href="/tentang"
                            class="nav-link block py-2.5 px-4 rounded-lg transition-all duration-200 hover:scale-105 relative"
                            :class="window.location.pathname === '/tentang' ?
                                'text-white bg-blue-600 hover:bg-blue-700 shadow-md' :
                                'text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 hover:text-blue-700'">Tentang</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Mobile Navigation -->
        <div class="lg:hidden" x-show="mobileMenuOpen" x-transition:enter="mobile-menu-enter"
            x-transition:enter-start="mobile-menu-enter" x-transition:enter-end="mobile-menu-enter-active"
            x-transition:leave="mobile-menu-exit" x-transition:leave-start="mobile-menu-exit"
            x-transition:leave-end="mobile-menu-exit-active" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 mt-4 bg-white rounded-lg shadow-lg border"
                :class="scrolled ? 'bg-white/95 backdrop-blur-sm' : 'bg-white'">
                <a href="/" @click="mobileMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200"
                    :class="window.location.pathname === '/' ?
                        'text-white bg-blue-600' :
                        'text-gray-700 hover:text-blue-600 hover:bg-blue-50'">Beranda</a>
                <a href="/dataset" @click="mobileMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200"
                    :class="window.location.pathname === '/dataset' ?
                        'text-white bg-blue-600' :
                        'text-gray-700 hover:text-blue-600 hover:bg-blue-50'">Data</a>
                <a href="/organization" @click="mobileMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200"
                    :class="window.location.pathname === '/organization' ?
                        'text-white bg-blue-600' :
                        'text-gray-700 hover:text-blue-600 hover:bg-blue-50'">Organisasi</a>
                <a href="/tentang" @click="mobileMenuOpen = false"
                    class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-200"
                    :class="window.location.pathname === '/tentang' ?
                        'text-white bg-blue-600' :
                        'text-gray-700 hover:text-blue-600 hover:bg-blue-50'">Tentang</a>
            </div>
        </div>
    </nav>
</header>
