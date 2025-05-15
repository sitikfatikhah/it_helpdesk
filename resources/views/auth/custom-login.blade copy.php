<!DOCTYPE html>
<html lang="en" class="h-full">
    <head>
        <title> IT Helpdesk</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <meta name="description" content="CreateTicket">
        <meta name="keywords" content="CreateTicket, Web Dashboard Create Ticket, Login CreateTicket">
        <meta name="author" content="IT_Helpdesk">
        @vite('resources/css/app.css') {{-- pastikan Vite terkonfigurasi --}}

        <link href="https://api.fontshare.com/v2/css?f[]=clash-display@600&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
rel="stylesheet">
    </head>

    <body class="flex flex-col min-h-screen bg-[#F1F4F5] font-['Poppins']">
        <nav class="flex flex-row mt-10 pb-12 pr-6 pl-6 justify-end">
            <div>
            <ul class="flex flex-row items-center gap-x-7">
                <li>
                    <a href="#" class="text-base text-stone-950 hover:font-semibold">
                            Home
                    </a>
                </li>
                <li>
                    <a href="#" class="text-base text-stone-950 hover:font-semibold">
                            Items
                    </a>
                </li>
                <li>
                    <a href="#" class="text-base text-stone-950 hover:font-semibold">
                            Knowledge Base
                    </a>
                </li>
                <li>
                    <a href="#" class="text-base text-stone-950 hover:font-semibold">
                            Pages
                    </a>
                </li>
            </ul>
        </div>
                <a href="#">
                    <div class="h-1/2 max-w-1/3 pl-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>  
                    </div>
                </a>
        </nav>

         <!-- Hero Section -->
    <section class="container mx-auto px-2 py-12 grid md:grid-cols-2 gap-12 items-center">
        <!-- Left Content -->
        <div>
            <h1 class="text-[#364DFA] text-3xl font-bold mb-4">WELCOME TO IT HELPDESK</h1>
            <p class="text-gray-700 mb-6">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua.
            </p>

            <h2 class="text-xl font-semibold mb-2">Reaching out a clue?</h2>
            <div class="flex items-center bg-blue-300 rounded-full overflow-hidden mb-6">
                <input
                    class="italic px-4 py-2 w-full bg-blue-300 placeholder-gray-700 focus:outline-none"
                    type="text"
                    placeholder="Type your question here"
                />
                <a href="#" class="bg-gray-200 px-4 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </a>
            </div>

            <h2 class="text-xl font-semibold">Cannot find an answer? Submit your ticket</h2>
            <a href="http://127.0.0.1:8000/app/login" class="bg-blue-600 text-white px-6 py-2 rounded-full inline-block mt-4">Submit Ticket</a>
        </div>

        <!-- Right Animation -->
        <div class="flex ">
            <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
            <dotlottie-player
                src="https://lottie.host/90bc2cdf-d55a-4924-8cec-dd275fb3cc20/jd3hfrqQ74.lottie"
                background="transparent"
                speed="1"
                style="width: 100%; max-width: 450px; height: 450px"
                loop
                autoplay>
            </dotlottie-player>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white mt-auto py-12">
        <div class="container mx-auto grid md:grid-cols-4 gap-6 text-center">
            <!-- Box 1 -->
            <div class="bg-[#D97D48] text-white p-12 rounded-lg shadow-md item-center">
                <a href="#">
                    <svg width="80px" height="80px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M512 469.333333m-426.666667 0a426.666667 426.666667 0 1 0 853.333334 0 426.666667 426.666667 0 1 0-853.333334 0Z" fill="#FFF59D"/><path d="M789.333333 469.333333c0-164.266667-140.8-294.4-309.333333-275.2-128 14.933333-230.4 117.333333-243.2 245.333334-10.666667 98.133333 29.866667 185.6 98.133333 241.066666 29.866667 25.6 49.066667 61.866667 49.066667 102.4v6.4h256v-2.133333c0-38.4 17.066667-76.8 46.933333-102.4 61.866667-51.2 102.4-128 102.4-215.466667z" fill="#FBC02D"/><path d="M652.8 430.933333l-64-42.666666c-6.4-4.266667-17.066667-4.266667-23.466667 0L512 422.4l-51.2-34.133333c-6.4-4.266667-17.066667-4.266667-23.466667 0l-64 42.666666c-4.266667 4.266667-8.533333 8.533333-8.533333 14.933334s0 12.8 4.266667 17.066666l81.066666 100.266667V789.333333h42.666667V554.666667c0-4.266667-2.133333-8.533333-4.266667-12.8l-70.4-87.466667 32-21.333333 51.2 34.133333c6.4 4.266667 17.066667 4.266667 23.466667 0l51.2-34.133333 32 21.333333-70.4 87.466667c-2.133333 4.266667-4.266667 8.533333-4.266667 12.8v234.666666h42.666667V563.2l81.066667-100.266667c4.266667-4.266667 6.4-10.666667 4.266666-17.066666s-4.266667-12.8-8.533333-14.933334z" fill="#FFF59D"/><path d="M512 938.666667m-64 0a64 64 0 1 0 128 0 64 64 0 1 0-128 0Z" fill="#5C6BC0"/><path d="M554.666667 960h-85.333334c-46.933333 0-85.333333-38.4-85.333333-85.333333v-106.666667h256v106.666667c0 46.933333-38.4 85.333333-85.333333 85.333333z" fill="#9FA8DA"/><path d="M640 874.666667l-247.466667 34.133333c6.4 14.933333 19.2 29.866667 34.133334 38.4l200.533333-27.733333c8.533333-12.8 12.8-27.733333 12.8-44.8zM384 825.6v42.666667L640 832v-42.666667z" fill="#5C6BC0"/></svg>
                </a>
                <p>Knowledge Base</p>
            </div>

            <!-- Box 2 -->
            <div class="bg-[#2ABF90] text-white p-6 rounded-lg shadow-md items-center">
                <a href="#">
                    <svg width="100px" height="100px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M320 853.333333h490.666667l128 128V533.333333c0-46.933333-38.4-85.333333-85.333334-85.333333H320c-46.933333 0-85.333333 38.4-85.333333 85.333333v234.666667c0 46.933333 38.4 85.333333 85.333333 85.333333z" fill="#558B2F"/><path d="M614.4 699.733333h-76.8l-14.933333 44.8h-46.933334l78.933334-213.333333h40.533333l78.933333 213.333333h-46.933333l-12.8-44.8z m-66.133333-34.133333h53.333333L576 584.533333l-27.733333 81.066667z" fill="#1B5E20"/><path d="M704 533.333333H213.333333l-128 128V170.666667c0-46.933333 38.4-85.333333 85.333334-85.333334h533.333333c46.933333 0 85.333333 38.4 85.333333 85.333334v277.333333c0 46.933333-38.4 85.333333-85.333333 85.333333z" fill="#8BC34A"/><path d="M541.866667 302.933333c0 21.333333-4.266667 38.4-10.666667 53.333334s-14.933333 27.733333-27.733333 36.266666l36.266666 27.733334-27.733333 25.6-46.933333-36.266667c-4.266667 0-10.666667 2.133333-17.066667 2.133333-12.8 0-25.6-2.133333-38.4-6.4-10.666667-4.266667-21.333333-12.8-29.866667-21.333333-8.533333-8.533333-14.933333-21.333333-19.2-34.133333-4.266667-12.8-6.4-27.733333-6.4-44.8v-8.533334c0-17.066667 2.133333-32 6.4-44.8 4.266667-12.8 10.666667-25.6 19.2-34.133333 8.533333-8.533333 17.066667-17.066667 29.866667-21.333333 10.666667-4.266667 23.466667-6.4 38.4-6.4 12.8 0 25.6 2.133333 38.4 6.4 10.666667 4.266667 21.333333 12.8 29.866667 21.333333 8.533333 8.533333 14.933333 21.333333 19.2 34.133333 4.266667 12.8 6.4 27.733333 6.4 44.8v6.4z m-46.933334-10.666666c0-23.466667-4.266667-40.533333-12.8-51.2-8.533333-12.8-19.2-17.066667-34.133333-17.066667-14.933333 0-27.733333 6.4-34.133333 17.066667-8.533333 12.8-12.8 29.866667-12.8 51.2v10.666666c0 10.666667 2.133333 21.333333 4.266666 29.866667 2.133333 8.533333 4.266667 17.066667 8.533334 21.333333 4.266667 6.4 8.533333 10.666667 14.933333 12.8 6.4 2.133333 12.8 4.266667 19.2 4.266667 14.933333 0 27.733333-6.4 34.133333-17.066667 8.533333-12.8 12.8-29.866667 12.8-53.333333v-8.533333z" fill="#FFFFFF"/>
                            </svg>
                </a>
                <p>FAQ</p>
            </div>

            <!-- Box 3 -->
            <div class="bg-[#1C71A6] text-white p-6 rounded-lg shadow-md items-center">
                <a href="#">
                    <svg fill="#000000" width="100px" height="100px" viewBox="0 0 24 24" id="video" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><path id="secondary" d="M17,14.62l2.55,1.27A1,1,0,0,0,21,15V9a1,1,0,0,0-1.45-.89L17,9.38ZM11,12,9,10.5v3Z" style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/><rect id="primary" x="3" y="6" width="14" height="12" rx="1" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"/></svg>
                </a>
                <p>Video Tutorial</p>
            </div>


            <!-- Box 4 -->
            <div class="bg-[#BABCBF] text-white p-6 rounded-lg shadow-md items-center">
                <a href="#">
                    <svg fill="#000000" width="100px" height="100px" viewBox="0 0 1069 1069" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect height="1066.67" id="Headset" style="fill:none;" width="1066.67" x="1.411" y="1.589"/><g>
                                    <path d="M863.764,641.673c0,-25.549 -10.149,-50.052 -28.215,-68.118c-18.066,-18.066 -42.569,-28.216 -68.118,-28.216l-0.108,0c-25.549,0 -50.052,10.15 -68.118,28.216c-18.066,18.066 -28.215,42.569 -28.215,68.118c-0,43.071 -0,99.334 -0,142.404c-0,25.549 10.149,50.052 28.215,68.118c18.066,18.066 42.569,28.216 68.118,28.216l0.108,-0c25.549,-0 50.052,-10.15 68.118,-28.216c18.066,-18.066 28.215,-42.569 28.215,-68.118l-0,-142.404Zm-465.265,0c0.001,-25.549 -10.149,-50.052 -28.215,-68.118c-18.066,-18.066 -42.568,-28.216 -68.118,-28.216l-0.108,0c-25.549,0 -50.052,10.15 -68.118,28.216c-18.066,18.066 -28.215,42.569 -28.215,68.118c0,43.071 0,99.334 0,142.404c0,25.549 10.149,50.052 28.215,68.118c18.066,18.066 42.569,28.216 68.118,28.216l0.108,-0c25.55,-0 50.052,-10.15 68.118,-28.216c18.066,-18.066 28.216,-42.569 28.215,-68.118l0,-142.404Zm402.765,-0l-0,142.404c-0,8.973 -3.565,17.579 -9.91,23.924c-6.344,6.345 -14.949,9.909 -23.922,9.91c-0.003,-0 -0.109,-0 -0.109,-0c-8.974,-0.001 -17.579,-3.565 -23.924,-9.91c-6.345,-6.345 -9.909,-14.951 -9.909,-23.924l-0,-142.404c-0,-8.973 3.564,-17.579 9.909,-23.924c6.345,-6.345 14.95,-9.909 23.923,-9.91c0.003,0 0.108,0 0.108,0c8.975,0.001 17.58,3.565 23.924,9.91c6.345,6.345 9.91,14.951 9.91,23.924Zm-465.265,-0l0,142.404c0,8.973 -3.564,17.579 -9.909,23.924c-6.345,6.345 -14.95,9.909 -23.922,9.91c-0.004,-0 -0.109,-0 -0.109,-0c-8.975,-0.001 -17.58,-3.565 -23.924,-9.91c-6.345,-6.345 -9.91,-14.951 -9.91,-23.924l0,-142.404c0,-8.973 3.565,-17.579 9.91,-23.924c6.344,-6.345 14.949,-9.909 23.922,-9.91c0.004,0 0.109,0 0.109,0c8.974,0.001 17.579,3.565 23.924,9.91c6.345,6.345 9.909,14.951 9.909,23.924Z" style="fill-opacity:0.5;"/>
                                    <path d="M946.603,714.727l-0,-221.472c-0.001,-201.353 -163.23,-364.582 -364.584,-364.582c-31.371,-0 -63.178,-0 -94.549,-0c-201.354,-0 -364.583,163.229 -364.583,364.582c-0,117.75 -0,221.472 -0,221.472c-0,17.248 14.002,31.25 31.25,31.25c17.247,0 31.25,-14.002 31.25,-31.25l-0,-221.47c0.001,-166.838 135.248,-302.084 302.083,-302.084c31.371,-0 63.178,-0 94.549,-0c166.836,-0 302.082,135.246 302.084,302.081c-0,0.003 -0,221.473 -0,221.473c-0,17.248 14.002,31.25 31.25,31.25c17.247,0 31.25,-14.002 31.25,-31.25Zm-504.911,-430.501l167.495,-0c17.247,-0 31.25,-14.003 31.25,-31.25c-0,-17.248 -14.003,-31.25 -31.25,-31.25l-167.495,-0c-17.248,-0 -31.25,14.002 -31.25,31.25c-0,17.247 14.002,31.25 31.25,31.25Z"/>
                                </g>
                            </svg>
                </a>
                <p>Contact Support</p>
            </div>
        </div>
    </footer>

    </body>
</html>