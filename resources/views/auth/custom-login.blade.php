<!DOCTYPE html>
<html lang="en">
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

    <body class="bg-[#F1F4F5] font-['Poppins']">
        <nav class="flex flex-row mt-10 pb-12 justify-end pr-6">
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
            

       <section>
        <div class="flex flex-cols-2 px-6">
            <div>
                <div>
                <div>
                <h1 class="text-[#364DFA] text-2xl font-bold">
                    WELCOME TO IT HELPDESK
                </h1>
                <h2 class="mt-2 text-gray-700">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor<br>
                    incididunt ut labore et dolore magna aliqua
                </h2>    
            </div>
    
            <div class="mt-6">
                <h1 class="text-xl font-semibold">
                    Reaching out a clue ?
                </h1>
                <h2>
                    
                        <div class="mt-3 inline-flex items-center bg-blue-300 rounded-full overflow-hidden">
                            <input class = "text px-4 italic px-4 py-2 bg-blue-300 placeholder-gray-700 focus:outline-none min-w-fit w-[220px]"  
                                type="text" placeholder="Type your question here"/>
                            
                                <a href='#' class="bg-gray-200 px-4 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-700" fill="none" viewBox="0 0 24 24"stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                                </a>
                            
                        </div>
                </h2>
            </div>
            <div class = py-6>
                <h1 class="text-xl font-semibold ">
                    Cannot find an answer ? Submit your ticket
                </h1>

                 <a href="http://127.0.0.1:8000/app/login" class="bg-blue-600 text-white px-4 py-2 rounded-full inline-block mt-1">
                    Submit Ticket
                </a>
            </div>
            </div>
            <div>
                <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
                    <dotlottie-player src="https://lottie.host/90bc2cdf-d55a-4924-8cec-dd275fb3cc20/jd3hfrqQ74.lottie" background="transparent" speed="1" style="width: 300px; height: 300px" loop autoplay>
                    </dotlottie-player>
            </div>
                    
            
        </div>
        
        <section class="footer w-screen mt-[230px] bg-[#070C29]">
            <div class="grid grid-cols-4 gap-y-10">
                <div class="bg-white text-black flex p-[9px] items-center space-x-2">
                    <a href="#">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15Z" stroke="#640EF1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M2.51999 7.11011H21.48" stroke="#640EF1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.51999 2.11011V6.97011" stroke="#640EF1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.48 2.11011V6.52011" stroke="#640EF1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.75 14.4501V13.2501C9.75 11.7101 10.84 11.0801 12.17 11.8501L13.21 12.4501L14.25 13.0501C15.58 13.8201 15.58 15.0801 14.25 15.8501L13.21 16.4501L12.17 17.0501C10.84 17.8201 9.75 17.1901 9.75 15.6501V14.4501V14.4501Z" stroke="#640EF1" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                    </a>
                    <p>
                        Knowledge Base
                    </p>

                </div>

            </div>
        </section>

    </body>
</html>