<div class="flex flex-col font-roboto">
    <section class="w-full pt-2 md:pt-6 bg-no-repeat bg-cover bg-center"
        style="background-image: url('{{ asset('images/bg-vector.png') }}');">
        <div class="container mx-auto px-8 lg:flex items-center">
            <!-- Left Column: Content and Search -->
            <div class="lg:w-1/2 flex flex-col justify-center">
                <h1 class="text-4xl lg:text-4xl xl:text-5xl font-bold leading-tight text-center lg:text-left">
                    <div><span class="text-blue-800 font-bold">Satu</span> <span
                            class="text-blue-600 font-bold">Data</span></div>
                    <div class="text-white-600">Kabupaten Sijunjung</div>
                </h1>
                <p class="text-xl lg:text-2xl mt-6 font-light max-w-2xl text-center lg:text-left">
                    Sijunjung yang
                    <span id="typing-text" class="typed-text"></span>
                    <span class="typing-cursor">|</span>
                </p>
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
                <div class="w-full max-w-3xl flex items-center justify-center image-container">
                    <img src="{{ asset('images/bupatiwakil.png') }}" alt="Bupati dan Wakil Bupati Sijunjung"
    class="w-full h-auto max-h-[500px] object-contain animate-slide-in-right shiny-navbar-style"
    style="animation: slideInRight 0.8s ease-out forwards;" id="bupati-image">
                </div>
            </div>
        </div>

        <style>
            .typing-cursor {
                display: inline-block;
                animation: blink 1s infinite;
                color: #1f2937;
                font-weight: bold;
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            }

            @keyframes blink {

                0%,
                50% {
                    opacity: 1;
                }

                51%,
                100% {
                    opacity: 0;
                }
            }

            .typed-text {
                display: inline-block;
                font-weight: bold;
                text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7), 1px 1px 2px rgba(0, 0, 0, 0.8);
            }

            .typed-text.bersih {
                color: #fcfcfc;
                /* Green */
                text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7), 1px 1px 2px rgba(0, 0, 0, 0.8), 0 0 10px rgba(16, 185, 129, 0.3);
            }

            .typed-text.berwibawa {
                color: #ffffff;
                /* Blue */
                text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7), 1px 1px 2px rgba(0, 0, 0, 0.8), 0 0 10px rgba(59, 130, 246, 0.3);
            }

            .typed-text.maju {
                color: #ffffff;
                /* Amber/Orange */
                text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7), 1px 1px 2px rgba(0, 0, 0, 0.8), 0 0 10px rgba(245, 158, 11, 0.3);
            }

            /* Shiny effect styles */
            .image-container {
                position: relative;
                overflow: hidden;
            }

            .shiny-image {
                /* legacy, can be removed if not used elsewhere */
            }
            .shiny-navbar-style {
                position: relative;
                overflow: hidden;
                display: block;
            }
            .shiny-navbar-style::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.7), transparent);
                transition: left 1.2s cubic-bezier(0.4,0,0.2,1);
                z-index: 10;
                pointer-events: none;
            }
            .shiny-navbar-style.auto-shine::before {
                left: 100%;
            }

            .shiny-image::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 15%; /* Adjusted width for a narrower shine */
                height: 100%;
                background: linear-gradient(to right,
                        rgba(255, 255, 255, 0) 0%,
                        rgba(255, 255, 255, 0.4) 40%,
                        rgba(255, 255, 255, 0.6) 50%,
                        rgba(255, 255, 255, 0.4) 60%,
                        rgba(255, 255, 255, 0) 100%);
                transform: translateX(-100%); /* Initial position: off-screen to the left, no rotation */
                pointer-events: none;
                z-index: 10;
            }

            .shiny-image.shine::before {
                transform: translateX(667%); /* End fully to the right (approx. 100 / 0.15 width percentage) */
                transform: translateX(200%) translateY(200%) rotate(45deg);
            }

            /* Auto shine animation */
            @keyframes autoShine {
                0% {
                    transform: translateX(-100%); /* Start fully to the left */
                }
                100% {
                    transform: translateX(667%); /* End fully to the right (approx. 100 / 0.15 width percentage) */
                }
            }

            .shiny-image.auto-shine::before {
                animation: autoShine 0.8s ease-in-out;
            }

            /* Optional: Add subtle glow effect during shine */
            .shiny-image.shine {
                filter: brightness(1.1);
                transform: scale(1.02);
            }

            .shiny-image.auto-shine {
                filter: brightness(1.1);
                transform: scale(1.02);
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Typing effect script
                const words = [{
                        text: 'Bersih',
                        class: 'bersih'
                    },
                    {
                        text: 'Berwibawa',
                        class: 'berwibawa'
                    },
                    {
                        text: 'Maju',
                        class: 'maju'
                    }
                ];
                const typingElement = document.getElementById('typing-text');
                const cursor = document.querySelector('.typing-cursor');

                let wordIndex = 0;
                let charIndex = 0;
                let isDeleting = false;
                let typingSpeed = 150;
                let deletingSpeed = 100;
                let pauseTime = 2000;

                function typeWriter() {
                    const currentWord = words[wordIndex];

                    if (isDeleting) {
                        typingElement.textContent = currentWord.text.substring(0, charIndex - 1);
                        charIndex--;

                        if (charIndex === 0) {
                            isDeleting = false;
                            wordIndex = (wordIndex + 1) % words.length;
                            setTimeout(typeWriter, 500);
                            return;
                        }
                        setTimeout(typeWriter, deletingSpeed);
                    } else {
                        typingElement.textContent = currentWord.text.substring(0, charIndex + 1);
                        typingElement.className = 'typed-text ' + currentWord.class;
                        charIndex++;

                        if (charIndex === currentWord.text.length) {
                            setTimeout(() => {
                                isDeleting = true;
                                typeWriter();
                            }, pauseTime);
                            return;
                        }
                        setTimeout(typeWriter, typingSpeed);
                    }
                }

                // Mulai efek ketik setelah delay singkat
                setTimeout(typeWriter, 1000);

                // Auto shiny effect script
                const bupatiImage = document.getElementById('bupati-image');

                function addShinyEffect() {
                    bupatiImage.classList.add('auto-shine');
                    setTimeout(() => {
                        bupatiImage.classList.remove('auto-shine');
                    }, 1200); // match navbar duration
                }
                setTimeout(() => {
                    addShinyEffect();
                    setInterval(addShinyEffect, 5000);
                }, 2000);
            });
        </script>
    </section>
</div>
