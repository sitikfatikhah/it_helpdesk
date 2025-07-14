<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>IT Helpdesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    {{-- <link rel="stylesheet"  href="{{ ('css/app.css') }}"> --}}
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
     <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</head>

<body class="bg-[#F1F4F5]">

    <!-- Navbar -->
    <header class="fixed px-24 top-0 left-0 w-full flex items-center z-10 border-b">
        <div class="flex justify-between items-center relative max-w-screen-xl mx-auto px-6 h-16">
                <div class="space-y-6 py-16">
                    <a href="home" class="space-y-6 font-bold text-lg text-primary block py-6">
                        IT Helpdesk
                    </a>
                </div>
                <div class="flex flex-row items-center px-4 space-x-4">
                    <button id="hamburger" name="hamburger" type="button" class="block absolute right-4 lg:hidden">
                        <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                        <span class="hamburger-line transition duration-300 ease-in-out"></span>
                        <span class="hamburger-line transition duration-300 ease-in-out origin-bottom-left"></span>
                    </button>

                    <nav id="nav-menu" class='hidden absolute px-4 py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-6 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none'>
                        <ul class="block lg:flex ">
                            <li class="group">
                                <a href="#home" class="text-base text-black py-2 mx-8 flex group-hover:text-[#364DFA]">Beranda</a>
                            </li>
                            <li class="group">
                                <a href="#knowledge" class="text-base text-black py-2 mx-8 flex  group-hover:text-[#364DFA] ">Knowledge</a>
                            </li>
                        </ul>
                    </nav>

                </div>

            </div>


        {{-- <div class="text-gray-400 text-sm"></div> <!-- your logo here--> --}}
        {{-- <nav class="flex items-center gap-6 text-sm text-gray-700"> --}}
            {{-- <a href="#">Home</a> --}}
            {{-- <a href="#">Items</a> --}}
            {{-- <a href="#">Knowledge</a> --}}
            {{-- <a href="#">Pages</a> --}}
            {{-- <a href="#" class="text-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>

            </a> --}}
        {{-- </nav> --}}
    </header>

    <!-- Hero Section -->
    <section class="container mx-auto px-24 py-10  grid md:grid-cols-2 gap-6 ">
        <!-- Left Content -->
        <div class="space-y-6 py-16">
            <h1 class="text-3xl font-bold text-[#364DFA] uppercase">Welcome to IT Helpdesk</h1>
            <p class="text-gray-600 text-sm">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt <br> ut labore et dolore magna aliqua.
            </p>

            <!-- Search Form -->
            <div class="flex items-center bg-gray-200 rounded-full overflow-hidden w-full max-w-md">
                <input
                    type="text"
                    placeholder="Looking for an answer ?"
                    class="px-4 py-2 w-full bg-gray-200 placeholder-gray-600 focus:outline-none text-sm"
                />
                <button class="px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 1 1 1.414-1.414l4.387 4.387a1 1 0 0 1-1.414 1.414l-4.387-4.387zM14 8a6 6 0 1 0-12 0 6 6 0 0 0 12 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Submit Ticket -->
            <div class="text-sm">
                <p class="mb-2">Cannot find an answer? Submit your ticket</p>
                <a href="{{ route('filament.app.auth.login') }}" class="inline-block bg-[#364DFA] text-white px-5 py-2 rounded-full text-sm font-medium">Submit Ticket</a>
            </div>
        </div>

        <!-- Right Image -->
        <div class="flex justify-center">
            <!-- Ganti dengan ilustrasi Anda jika punya file khusus -->
             <dotlottie-player
                src="https://lottie.host/90bc2cdf-d55a-4924-8cec-dd275fb3cc20/jd3hfrqQ74.lottie"
                background="transparent"
                speed="0.75"
                style="width: 100%; max-width: 450px; height: 450px"
                loop
                autoplay
                class="max-w-sm w-full h-auto">
            </dotlottie-player>
        </div>
    </section>

    <!-- Blog Section Start -->

    {{-- <section id="knowledge" class="pt-5 pb-24 container px-24 py-10 w-full">
        <div class="container">
            <div class="w-full px-4">
                <div class="max-w-xl space-y-6 mb-10 mx-auto text-center">
                        <h1 class="text-3xl font-bold text-[#364DFA] uppercase">Knowledge Base</h1>


                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tips menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tips menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tips menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tips menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tips menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tips menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section> --}}

    <!-- Blog Section End -->

    <!-- Video Section Start -->
    {{-- <section id="video" class="container px-24 w-full">
        <div class="container">
            <div class="w-full">
                <div class="max-w-xl mb-10 mx-auto text-center">
                        <h1 class="text-3xl font-bold text-[#364DFA] uppercase">Video Tutorial</h1>


                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tutorial menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tutorial menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tutorial menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-wrap">
                    <div class="w-full px-2">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-10 flex flex-row items-start">
                            <img src="image/printer.jpg" alt="Printer" class="w-full pt-6">
                            <div class="py-8 px-6 w-2/3">
                                <h3>
                                <a href="#" class="block mb-3 font-semibold text-xl hover:text-primary truncate">Tutorial menghubungkan printer</a>
                                </h3>
                                <p class="md:text-base truncate">Lorem ipsum dolor sit amet, consectetur adipiscing</p>
                                <a href="#" class="text-sm text-[#364DFA]">Baca selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section> --}}

    <!-- Video Section End -->

    <!-- Feature Boxes -->
    <section class="grid grid-cols-2 md:grid-cols-4 mt-5">
        <!-- Knowledge Base -->
        <div class="bg-[#D97D48] text-white flex flex-col items-center justify-center py-8">
            <svg class="w-12 h-12 mb-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 14h-2v-2h2v2zm0-4h-2V7h2v5z" />
            </svg>
            <p class="text-sm font-semibold">Knowledge Base</p>
        </div>

        <!-- FAQ -->
        <div class="bg-[#2ABF90] text-white flex flex-col items-center justify-center py-8">
            <svg class="w-12 h-12 mb-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2a10 10 0 00-10 10h2a8 8 0 1116 0h2a10 10 0 00-10-10zm-1 14h2v2h-2v-2zm1-12a10 10 0 00-1 .07v2.02a8 8 0 010 15.84v2.02a10 10 0 001-.07A10 10 0 0012 4z"/>
            </svg>
            <p class="text-sm font-semibold">FAQ</p>
        </div>

        <!-- Video Tutorials -->
        <div class="bg-[#1C71A6] text-white flex flex-col items-center justify-center py-8">
            <svg class="w-12 h-12 mb-2" fill="currentColor" viewBox="0 0 24 24">
                <path d="M10 16.5l6-4.5-6-4.5v9zM21 6.5v11c0 .825-.675 1.5-1.5 1.5h-15C3.675 19.5 3 18.825 3 18V6c0-.825.675-1.5 1.5-1.5h15c.825 0 1.5.675 1.5 1.5z"/>
            </svg>
            <p class="text-sm font-semibold">Video Tutorials</p>
        </div>

        <!-- Support -->
        <div class="bg-[#BABCBF] text-white flex flex-col items-center justify-center py-8">
            <svg class="w-12 h-12 mb-2" height="" width="" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
        <path style="fill:#E6E5E5;" d="M95.464,359.232l321.48-229.216l92.495,89.772C491.845,95.555,385.091,0,256,0  C114.615,0,0,114.615,0,256c0,139.851,112.147,253.493,251.414,255.942L95.464,359.232z"/>
        <path style="fill:#CCCBCA;" d="M95.464,359.232l155.95,152.71c1.527,0.027,3.053,0.058,4.586,0.058c141.385,0,256-114.615,256-256  c0-12.294-0.886-24.38-2.561-36.212l-92.495-89.772L95.464,359.232z"/>
        <g>
	    <polygon style="fill:#FFFFFF;" points="362.736,347.888 362.736,441.272 244.448,347.888  "/>
	    <path style="fill:#FFFFFF;" d="M404.76,363.872H107.24c-9.552,0-17.376-7.816-17.376-17.376V142.368   c0-9.552,7.816-17.376,17.376-17.376h297.512c9.552,0,17.376,7.816,17.376,17.376v204.136   C422.128,356.056,414.312,363.872,404.76,363.872z"/>
        </g>
        <g>
	    <circle style="fill:#333333;" cx="257.85" cy="189.84" r="107.44"/>
	    <polygon style="fill:#333333;" points="194.032,330.264 194.032,254.304 288.992,254.304  "/>
        </g>
        <g>
	    <circle style="fill:#FFFFFF;" cx="199.43" cy="190.5" r="17.784"/>
	    <circle style="fill:#FFFFFF;" cx="257.85" cy="190.5" r="17.784"/>
	    <circle style="fill:#FFFFFF;" cx="316.26" cy="190.5" r="17.784"/>
	    <path style="fill:#FFFFFF;" d="M275.632,190.496c0-9.824-7.96-17.784-17.784-17.784s-17.784,7.96-17.784,17.784   c0,9.824,17.784,17.784,17.784,17.784C267.672,208.28,275.632,200.312,275.632,190.496z"/>
        </g>
        </svg>
            <p class="text-sm font-semibold">Support</p>
        </div>
    </section>
    @vite(['resources/js/script.js'])
</body>



</html>
