<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $page }} | Kerelka</title>

  <link rel="shortcut icon" href="{{ asset('icons/Icon.png') }}" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>
    {{-- medsos --}}
    <div data-aos="fade-down" data-aos-duration="1000" class="fixed right-2 top-0 bottom-0 text-center hidden lg:flex flex-col justify-center items-center gap-4 text-red-500">
        <p class="rotate-90 text-lg w-full mb-24">FOLLOW ME ON: </p>
        <span class="w-16 h-1 rotate-90 bg-red-500 mb-8"></span>
        <a href="#" class="text-2xl"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" class="text-2xl"><i class="fa-brands fa-instagram"></i></a>
        <a href="#" class="text-2xl"><i class="fa-brands fa-linkedin-in"></i></a>  
    </div>
    {{-- end of medsos --}}

    <div id="fullpage">
        {{-- hero --}}
        <div 
        class="section bg-[#2A2B4A] bg-no-repeat bg-cover bg-center bg-fixed text-gray-200 font-sans min-h-screen px-4 sm:px-18 md:px-28 lg:px-48 py-4 md:py-6 lg:py-10"
        style="background-image: url({{ asset('images/bg1.jpg') }})">
            <div class="w-full h-full flex flex-col items-stretch py-5">
                <div id="nav" class="flex flex-col sm:flex-row gap-2 sm:gap-0 justify-between items-center mb-10">
                    <div class="h-8 lg:h-12">
                        <img src="{{ asset('icons/brand-icon.png') }}" alt="logo" data-aos="fade-down" data-aos-duration="1000" class="h-full object-cover">
                    </div>
                    <div id="menu" data-aos="fade-up" data-aos="fade-up" data-aos-duration="1500" class="flex items-start gap-2 lg:gap-4 text-lg">
                        <a href="/aboutme" class="p-2 text-sm md:text-base border-b-4 border-red-500">About Me</a>
                        <a href="/blogs" class="p-2 text-sm md:text-base ">Blogs</a>
                        <a href="{{ asset('files/kerel-khalif-afif-cv.pdf') }}" target="_blank" class="text-sm md:text-base rounded bg-red-500 hover:bg-red-800 p-2">Download CV</a>
                    </div>
                </div>
                <div id="introduction" class="flex flex-col-reverse md:flex-row justify-between gap-10 md:gap-4">
                    <div data-aos="fade-up" data-aos-duration="2000" class="w-full md:w-1/2 flex flex-col gap-2 md:gap-4">
                        <p class="text-gray-400 text-sm md:text-lg text-center md:text-left">- Introduction</p>
                        <h2 class="text-2xl md:text-4xl text-center md:text-left">Web programming and <br>Developer, based in <br>Indonesia.</h2>
                        <p class="text-gray-400 text-sm md:text-base text-center md:text-left sm:w-4/6">Seorang programmer yang sangat tertarik pada pemprograman website yang terus berkembang setiap harinya dengan teknologi terbaru yang mengikutinya.</p>
                        <a href="#experience" class="text-yellow-500 md:text-lg flex justify-center md:justify-start gap-2 md:gap-4 items-center"><span class="hover:underline py-2">My Story</span> <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div data-aos="flip-up" data-aos-duration="2500" class="w-full md:w-1/2 flex justify-center lg:justify-end items-center">
                        <h1 class="text-6xl lg:text-7xl font-bold font-orbitron drop-shadow-2xl">KEREL KHALIF AFIF</h1>
                    </div>
                </div>
            </div>


        </div>
        {{-- end of hero --}}

        {{-- my experiences --}}
        <div
        id="experience"
        class="section bg-white bg-no-repeat bg-cover bg-center bg-fixed text-gray-800 font-sans px-4 sm:px-18 md:px-28 lg:px-48 py-4 md:py-6 lg:py-10 flex flex-col gap-5 md:10 lg:gap-20">
            <h1 class="text-center text-3xl md:text-5xl font-bold mb-5">EXPERIENCES</h1>
            <div class="flex flex-col-reverse sm:flex-row">
               <div class="text-gray-800 w-full sm:w-3/4 px-8">
                <p class="text-lg"><i class="fa-solid fa-caret-right"></i> Learn and work in programming with more than 2year++ experiences.</p>
                <p class="text-2xl italic mt-8 font-bold">HAVE HIGH PASSION IN PROGRAMMING</span></p>
                <p class="mt-4 text-lg">Skills:</p>
                <p class="flex gap-5 text-xl"><i class="fa-brands fa-php"></i>PHP</p>
                <p class="flex gap-6 text-xl"><i class="fa-brands fa-laravel"></i>Laravel</p>
                <p class="flex gap-5 text-xl"><i class="fa-solid fa-sitemap"></i>Web Development</p>
                <p class="flex gap-6 text-xl"><i class="fa-brands fa-js"></i>JavaScript</p>
                <p class="flex gap-6 text-xl"><i class="fa-brands fa-css3-alt"></i> CSS</p>
               </div>
                <div class="w-full sm:w-1/2 overflow-hidden">
                    <img src="{{ asset('images/bg-design3.png') }}" alt="" class="w-full object-cover">
                </div>
            </div>
        </div>

        {{-- end of my experiences --}}

        {{-- portfolio --}}
        <div
        class="section bg-white bg-no-repeat bg-cover bg-center bg-fixed text-gray-800 font-sans min-h-screen px-4 sm:px-18 md:px-28 lg:px-48 py-4 md:py-6 lg:py-10 flex flex-col gap-5">
            <div class="flex flex-col md:flex-row md:justify-between gap-5 items-center">
                <div class="w-full md:w-1/2">
                    <h1 class="text-3xl text-center md:text-left md:text-5xl mt-10 mb-5 font-serif">Portfolio</h1>
                    <p class="text-gray-400 text-xs md:text-sm text-center md:text-left">View all my work here,still learn not even close to profesional. hope you like it.</span></p>
                </div>
                <div class="w-full md:w-1/2 flex  justify-around md:justify-end gap-5 text-sm">
                    <button id="btnDesign" onclick="togglePortfolio('design')" class="p-1 w-1/3 md:w-fit md:p-4 bg-red-500 hover:bg-red-500 text-gray-200 transition-all ease-in-out">Designs</button>
                    <button id="btnProject" onclick="togglePortfolio('project')" class="p-1 w-1/3 md:w-fit md:p-4 hover:bg-red-500 hover:text-gray-200 transition-all ease-in-out">Projects</button>
                </div>
            </div>
            <div id="design" class="flex flex-wrap items-center">
                @foreach($designs as $design)
                <div class="w-full sm:w-1/2 md:w-1/3 p-4">
                    <div class="w-full h-full bg-blue-400/50 relative rounded overflow-hidden">
                        <img src="{{ asset('storage/'. $design->image) }}" alt="" class="w-full h-full object-cover">
                        <div class="absolute inset-0 transition-all ease-in-out hover:bg-gray-800/20">
                            <a href="/designs/{{ $design->slug }}" class="w-full h-full flex justify-center items-center opacity-0 hover:opacity-100 font-bold">Click me</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div id="project" class="hidden flex-wrap items-center">
                @foreach($projects as $project)
                <div class="w-full sm:w-1/2 md:w-1/3 p-4">
                    <div class="w-full h-full bg-blue-400/50 relative rounded overflow-hidden">
                        <img src="{{ asset('storage/'. $project->image) }}" alt="" class="w-full h-full object-cover">
                        <div class="absolute inset-0 transition-all ease-in-out hover:bg-gray-800/20">
                            <a href="/projects/{{ $project->slug }}" class="w-full h-full flex justify-center items-center opacity-0 hover:opacity-100 font-bold">Click me</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="">
                <div class="flex justify-center items-center">
                    <a id="projects" href="/projects" class="hidden py-2 md:py-4 px-4 md:px-8 bg-red-500 text-gray-200">View All</a>
                    <a id="designs" href="/designs" class="py-2 md:py-4 px-4 md:px-8 bg-red-500 text-gray-200">View All</a>
                </div>
            </div>
        </div>
        {{-- end of portfolio --}}

        {{-- contact me --}}
        <div class="section bg-[#2A2B4A] text-gray-200 font-sans min-h-screen px-4 sm:px-18 md:px-28 lg:px-48 py-4 md:py-6 lg:py-10 flex flex-col gap-5">
            <div class="w-full flex flex-col md:flex-row md:justify-between gap-4">
                <div data-aos="fade-right" data-aos-duration="2000" class="w-full md:w-1/4">
                    <h1 class="font-serif text-3xl text-center md:text-left md:text-5xl mb-2 md:mb-5">Contact Me</h1>
                    <p class="text-sm text-gray-400 text-center md:text-left">Bussiness ? reach me out in my media social network</p>
                    <div class="mt-5 px-4 md:px-0">
                        <div class="flex flex-col items-start mb-3 gap-2">
                            <p class="p-2 bg-red-500 rounded-lg text-sm">Phone Number</p>
                            <p class="italic text-gray-400">(+62) 812 5063 1693</p>
                        </div>
                        <div class="flex flex-col items-start mb-3 gap-2">
                            <p class="p-2 bg-red-500 rounded-lg text-sm">Gmail</p>
                            <p class="italic text-gray-400">kerelkaa@gmail.com</p>
                        </div>
                        <div class="flex flex-col items-start mb-3 gap-2">
                            <p class="p-2 bg-red-500 rounded-lg text-sm">Address</p>
                            <p class="italic text-gray-400">Jln. KGS Hasan No. 50 001/001, Kel. Pasar Ujung, <br>Kab. Kepahiang, Prov. Bengkulu <br>Indoneia (39372)</p>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-duration="1500" class="w-full md:w-2/4 px-4 md:px-0">
                    <h2 class="text-3xl md:text-5xl font-serif mb-5 md:mb-10">Drop a Line</h2>
                    @if(session('message'))
                        <p class="text-green-800 bg-green-200 px-1 mb-3">{{ session('message') }}</p>
                    @endif
                    @if(session('error'))
                        <p class="text-red-800 bg-red-200 px-1 mb-3">{{ session('error') }}</p>
                    @endif
                    <form method="POST" class="flex flex-wrap gap-3 md:gap-4 items-start">
                        @csrf
                        <input type="text" name="name" id="name" required placeholder="Name" class="text-sm md:text-base p-1 md:p-3 placeholder:italic outline-none border border-gray-400 bg-transparent">
                        <input type="email" name="email" id="email" required placeholder="yourmail@gmail.com" class="text-sm md:text-base p-1 md:p-3 placeholder:italic outline-none border border-gray-400 bg-transparent">
                        <input type="text" name="phone" id="phone" required placeholder="Phone number" class="text-sm md:text-base p-1 md:p-3 placeholder:italic outline-none border border-gray-400 bg-transparent">
                        <input type="text" name="subject" id="subject" required placeholder="Subject" class="text-sm md:text-base p-1 md:p-3 placeholder:italic outline-none border border-gray-400 bg-transparent">
                        <textarea name="message" id="message" cols="30" rows="5" style="resize: none;" required placeholder="Messages..." class="text-sm md:text-base p-1 md:p-3 placeholder:italic outline-none border border-gray-400 bg-transparent w-full"></textarea>
                        <button type="submit" class="py-2 px-5 md:py-4 md:px-10 bg-red-500 hover:bg-red-800 transition-all ease-in-out mt-4 md:mt-10">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-[#1B203D] bg-no-repeat bg-cover bg-center bg-fixed flex justify-center items-center text-gray-200 font-sans px-4 sm:px-18 md:px-28 lg:px-48 py-4 md:py-6 lg:py-10"
        style="background-image: url({{ asset('images/bg5.jpg') }});">
            <div class="rounded-full h-60 w-60 md:h-96 md:w-96 p-10 border border-gray-400 flex flex-col justify-center items-center">
                <h1 class="font-serif text-3xl md:text-5xl mb-2">Lets Say Hi</h1>
                <p class="text-gray-400 text-sm md:text-base text-center italic mb-4">kerelkaa@gmail.com</p>
                <div class="flex justify-center items-center gap-3 text-2xl">
                    <a href="#" class="text-blue-500"><i class="fa-brands fa-facebook-square"></i></a>
                    <a href="#" class="text-red-500"><i class="fa-brands fa-instagram-square"></i></a>
                    <a href="#" class="text-blue-400"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <footer class="p-4 bg-[#0c0e1b] text-center">
            <p class="text-gray-400 italic text-xs md:text-sm">&copy; Copyright 2022 by kerelka.com</p>
        </footer>
    </div>


    <script>
       $('document').ready(function() {
           AOS.init();
       })
       function togglePortfolio(i) {
            let btnDesignEl = document.getElementById('btnDesign');
            let btnProjectEl = document.getElementById('btnProject');
            let designEl = document.getElementById('design');
            let projectEl = document.getElementById('project');
            let linkProjectsEl = document.getElementById('projects');
            let linkDesignsEl = document.getElementById('designs');

            if(i == 'design'){
                designEl.classList.remove('hidden');
                designEl.classList.add('flex');
                projectEl.classList.add('hidden');
                projectEl.classList.remove('flex');
                btnDesignEl.classList.add('text-gray-200', 'bg-red-500');
                btnProjectEl.classList.remove('text-gray-200', 'bg-red-500');
                linkDesignsEl.classList.remove('hidden');
                linkProjectsEl.classList.add('hidden');
            }else{
                designEl.classList.add('hidden');
                designEl.classList.remove('flex');
                projectEl.classList.remove('hidden');
                projectEl.classList.add('flex');
                btnDesignEl.classList.remove('text-gray-200', 'bg-red-500');
                btnProjectEl.classList.add('text-gray-200', 'bg-red-500');
                linkDesignsEl.classList.add('hidden');
                linkProjectsEl.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>