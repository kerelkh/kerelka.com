<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KerelKA</title>
    <link rel="shortcut icon" href="{{ asset('icons/Icon.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="box absolute -z-50">
        <div class='wave -one'></div>
        <div class='wave -two'></div>
        <div class='wave -three'></div>
    </div>
    {{-- sidenav --}}
    <div id="sidenav" class="transition-all duration-300 ease-in-out fixed top-0 bottom-0 right-0 w-0 z-50 overflow-hidden bg-primary">
        <button onclick="toggleMenu()" class="absolute top-4 right-4 text-gray-200 hover:text-white"><i class="fa-solid fa-x"></i></button>
        <div class="mt-16 flex flex-col items-stretch">
            <a href="/" class="py-2 px-4 first-letter:uppercase text-gray-300 hover:text-white text-sm md:text-lg"><i class="fa-solid fa-caret-right"></i> Home</a>
            <a href="/blogs" class="py-2 px-4 first-letter:uppercase text-gray-300 hover:text-white text-sm md:text-lg"><i class="fa-solid fa-caret-right"></i> Blogs</a>
            <a href="/aboutme" class="py-2 px-4 first-letter:uppercase text-gray-300 hover:text-white text-sm md:text-lg"><i class="fa-solid fa-caret-right"></i> About me</a>
            <a href="/projects" class="py-2 px-4 first-letter:uppercase text-gray-300 hover:text-white text-sm md:text-lg"><i class="fa-solid fa-caret-right"></i> Projects</a>
            <a href="/designs" class="py-2 px-4 first-letter:uppercase text-gray-300 hover:text-white text-sm md:text-lg"><i class="fa-solid fa-caret-right"></i> Design</a>
        </div>
    </div>
    <div id="app" class="px-1 sm:px-6 xl:px-24 text-white font-medium font-sans">
        {{-- nav top --}}
        <div class="py-1 md:py-3 lg:py-6 flex justify-between items-center">
            <div class="w-full md:w-fit flex md:space-x-10 justify-between items-center">
                <div class="w-32">
                    <a href="/" class="block">
                        {{-- <img src="{{ asset('icons/icon-black.png') }}" alt="Logo" class="object-cover"> --}}
                        <h3 class="tracking-widest uppercase font-bold text-2xl">KEREL<span class="text-blue-500">K</span>A</h3>
                    </a>
                </div>
                <div class="hidden md:flex justify-center items-center space-x-5">
                    <a href="/aboutme" class="font-medium hover:underline transition">About me</a>
                    <a href="/blogs" class="font-medium hover:underline transition">Blogs</a>
                    <a href="/projects" class="font-medium hover:underline transition">Projects</a>
                    <a href="/designs" class="font-medium hover:underline transition">Designs</a>
                </div>
                <div>
                    <button onclick="toggleMenu()" class="md:hidden text-2xl text-gray-300 hover:text-white p-2"><i class="fa-solid fa-bars"></i></button>
                </div>
            </div>
            <div class="hidden md:flex space-x-10 items-center text-white">
                <a href="https://www.facebook.com/kerelka" target="_blank" class="animate-bounce hover:underline transition"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="animate-bounce hover:underline transition"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.instagram.com/kerelkh/" target="_blank" class="animate-bounce hover:underline transition"><i class="fa-brands fa-instagram-square"></i></a>
            </div>
        </div>

        <div class="py-6 flex items-start">
            <div class="w-2/3 lg:aspect-video hidden md:flex py-5 pr-5 rounded-3xl">
                @if($newestPost != null)
                <div class="w-full h-full relative rounded-3xl overflow-hidden group transition duration-500 ease-in-out hover:ring-4 hover:ring-[#1B2B45]">
                    <img src="{{ asset('storage/' . $newestPost->thumbnail) }}" alt="hightlight" class="w-full h-full">
                    <div class="absolute inset-0 flex flex-col space-y-5 justify-end items-start p-10 hover:bg-[#151F32]/20 transition duration-500 ease-in-out">
                        <a href="/blogs?category={{ $newestPost->getCategory->category_name }}" class="bg-gradient-to-br from-blue-500 to-purple-500 py-1 px-4 rounded-2xl">{{ $newestPost->getCategory->category_name }}</a>
                        <a href="/blogs/{{ $newestPost->slug }}" class="text-3xl w-3/4 line-clamp-2">{{ $newestPost->title }}</a>
                        <p class="text-gray-300 text-sm">Kerel Khalif Afif  {{ $newestPost->updated_at->format('d M Y') }}</p>
                    </div>
                </div>
                @else
                <div class="w-full h-full relative rounded-3xl overflow-hidden group transition duration-500 ease-in-out hover:ring-4">
                    <h1 class="text-center p-5 text-gray-800">No Data present</h1>
                </div>
                @endif
            </div>
            <div class="w-full md:w-1/3 h-fit py-5 md:pr-5 overflow-hidden rounded-3xl">
                <div class="rounded-xl flex flex-col">
                    <div class="flex px-2 md:px-10 py-5 rounded-xl justify-between items-center mb-6 bg-gradient-to-b from-secondary to-secondary/20">
                        <button id="btnPopular" onclick="togglePopularRecent('popular')" class="outline-none py-1 px-4 text-white hover:text-white  tracking-wider uppercase font-bold">Popular</button>
                        <button id="btnRecent" onclick="togglePopularRecent('recent')" class="outline-none py-1 px-4 text-gray-400 hover:text-white  tracking-wider uppercase font-bold">Recent</button>
                    </div>
                    @if($mostViewPosts != null)
                    <div id="popular">
                        @foreach($mostViewPosts as $post)
                        <div class="flex bg-gradient-to-r from-secondary to-secondary/20 space-x-5 px-2 md:px-10 py-5 rounded-xl mb-2">
                            <div class="w-12 md:w-20 aspect-square rounded-xl overflow-hidden">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="w-3/4 flex flex-col justify-between">
                                <a href="blogs/{{ $post->slug }}" class="text-gray-200 hover:text-white capitalize">
                                    <h3 class="line-clamp-2 font-semibold text-sm md:text-base">{{ $post->title }}</h3>
                                </a>
                                <p class="text-xs md:text-sm text-gray-400">{{ $post->updated_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @if($recentPosts != null)
                    <div id="recent" class="hidden">
                        @foreach($recentPosts as $post)
                            <div class="flex bg-gradient-to-r from-secondary to-secondary/20 space-x-5 px-2 md:px-10 py-5 rounded-xl mb-2">
                                <div class="w-12 md:w-20 aspect-square rounded-xl overflow-hidden">
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="w-full h-full object-cover">
                                </div>
                                <div class="w-3/4 flex flex-col justify-between">
                                    <a href="blogs/{{ $post->slug }}" class="text-gray-200 hover:text-white capitalize">
                                        <h3 class="line-clamp-2 font-semibold text-sm md:text-base">{{ $post->title }}</h3>
                                    </a>
                                    <p class="text-xs md:text-sm text-gray-400">{{ $post->updated_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex py-5 flex-col lg:flex-row">
            <div class="w-full lg:w-2/3 lg:pr-5">
                {{-- Editor's Pick --}}
                <h1 class="text-xl font-semibold text-white uppercase mb-6">Editor's Pick <span class="text-transparent bg-clip-text bg-blue-500"><i class="fa-solid fa-star"></i></span></h1>
                <div class="w-full mb-5 lg:mb-10">
                    <div class="flex flex-col lg:flex-row items-start">
                        @if($randomPosts != null)
                            <div class="w-full lg:w-1/2 p-4 lg:p-8 rounded-3xl bg-gradient-to-b from-secondary to-primary mb-5 lg:mb-0">
                                <div class="w-full aspect-video rounded-3xl overflow-hidden relative group transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/' . $randomPosts[0]->thumbnail) }}" alt="thumbnail {{ $randomPosts[0]->title }}" class="w-full h-full transition duration-300 ease-in-out rounded">
                                    <div class="absolute inset-0 p-5">
                                        <a href="/blogs?category={{ $randomPosts[0]->getCategory->category_name }}" class="bg-gradient-to-br from-blue-500 to-purple-500 py-1 px-4 rounded-2xl">{{ $randomPosts[0]->getCategory->category_name }}</a>
                                    </div>
                                </div>
                                <div class="my-5 flex space-x-4 items-center">
                                    {{-- <div class="w-10 h-10 rounded overflow-hidden">
                                        <img src="{{ asset('images/writer.webp') }}" alt="author" class="w-full h-full object-cover">
                                    </div> --}}
                                    <p class="text-gray-200 text-sm">{{ $randomPosts[0]->author }} {{ $randomPosts[0]->updated_at->format('d M Y') }}</p>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <a href="/blogs/{{ $randomPosts[0]->slug }}" class="line-clamp-3 font-semibold text-white capitalize text-lg">{{ $randomPosts[0]->title }}</a>
                                    <p class="text-gray-200 text-sm line-clamp-4">{{ $randomPosts[0]->description }}</p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/2 lg:pl-2">
                                <div class="flex flex-col space-y-2">
                                    @foreach($randomPosts as $post)
                                        @if($loop->index != 0)
                                            <div class="flex space-x-2 p-4 lg:p-8 bg-gradient-to-r from-secondary to-secondary/20 rounded-3xl">
                                                <div class="w-1/3 aspect-[4/3] rounded-xl overflow-hidden">
                                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="w-full h-full object-cover">
                                                </div>
                                                <div class="w-2/3 flex flex-col space-y-4">
                                                    <a href="/blogs/{{ $post->slug }}" class="font-semibold line-clamp-2 text-gray-200 hover:text-white capitalize">{{ $post->title }}</a>
                                                    <p class="text-sm text-gray-200">{{ $post->updated_at->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- banner --}}
                <div class="w-full h-24 overflow-hidden mb-2 lg:mb-10">
                    <img src="{{ asset('images/banner1.jpg') }}" alt="" class="object-cover">
                </div>

                {{-- Trending --}}
                <h1 class="text-xl font-semibold text-white uppercase mb-6">Trending <span class="text-transparent bg-clip-text bg-blue-500"><i class="fa-solid fa-fire"></i></span></h1>
                <div class="w-full mb-10">
                    <div class="flex flex-col space-y-8">
                        @if($mostViewPosts != null)
                        <div class="w-full flex flex-col lg:flex-row space-y-5 lg:space-y-0 gap-5 items-start">
                            <div class="w-full lg:w-1/2 p-2 lg:p-8 bg-gradient-to-b from-secondary to-primary rounded-3xl">
                                <div class="w-full aspect-video rounded-3xl overflow-hidden relative transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/' . $mostViewPosts[0]->thumbnail) }}" alt="Thumbnail {{ $mostViewPosts[0]->title }}" class="w-full h-full  transition duration-300 ease-in-out rounded-2xl object-cover">
                                    <div class="absolute inset-0 p-5">
                                        <a href="/blogs?category={{ $mostViewPosts[0]->getCategory->category_name }}" class="bg-gradient-to-br from-blue-500 to-purple-500 py-1 px-4 rounded-2xl">{{ $mostViewPosts[0]->getCategory->category_name }}</a>
                                    </div>
                                </div>
                                <div class="my-5 flex space-x-4 items-center">
                                    {{-- <div class="w-10 h-10 rounded overflow-hidden">
                                        <img src="{{ asset('images/writer.webp') }}" alt="author" class="w-full h-full object-cover">
                                    </div> --}}
                                    <p class="text-gray-200 text-sm">{{ $mostViewPosts[0]->author }} {{ $mostViewPosts[0]->updated_at->format('d M Y') }}</p>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <a href="/blogs/{{ $mostViewPosts[0]->slug }}" class="line-clamp-3 font-semibold text-white hover:text-gray-200 text-lg capitalize">{{ $mostViewPosts[0]->title }}</a>
                                    <p class="text-gray-200 text-sm line-clamp-4">{{ $mostViewPosts[0]->description }}</p>
                                </div>
                            </div>
                            @if($mostViewPosts->count() > 1)
                            <div class="w-full lg:w-1/2 p-2 lg:p-8 bg-gradient-to-b from-secondary to-primary rounded-3xl">
                                <div class="w-full aspect-video rounded-3xl overflow-hidden relative  transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/' . $mostViewPosts[1]->thumbnail) }}" alt="Thumbnail {{ $mostViewPosts[1]->title }}" class="w-full h-full transition duration-300 ease-in-out rounded-2xl object-cover">
                                    <div class="absolute inset-0 p-5">
                                        <a href="/blogs?=categories={{ $mostViewPosts[1]->getCategory->category_name }}" class="bg-gradient-to-br from-blue-500 to-purple-500 py-1 px-4 rounded-2xl">{{ $mostViewPosts[1]->getCategory->category_name }}</a>
                                    </div>
                                </div>
                                <div class="my-5 flex space-x-4 items-center">
                                    {{-- <div class="w-10 h-10 rounded overflow-hidden">
                                        <img src="{{ asset('images/writer.webp') }}" alt="author" class="w-full h-full object-cover">
                                    </div> --}}
                                    <p class="text-gray-200 text-sm">{{ $mostViewPosts[1]->author }} {{ $mostViewPosts[1]->updated_at->format('d M Y') }}</p>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <a href="/blogs/{{ $mostViewPosts[1]->slug }}" class="line-clamp-3 font-semibold text-gray-200 hover:text-white text-lg capitalize">{{ $mostViewPosts[1]->title }}</a>
                                    <p class="text-gray-200 text-sm line-clamp-4">{{ $mostViewPosts[1]->description }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                        <div class="w-full">
                            <form method="GET">
                                <input type="search" name="keyword" id="keyword" placeholder="Search..." class="w-full p-2 rounded-xl outline-none focus:ring-2 focus:ring-primary placeholder:italic capitalize text-sm text-gray-200 bg-secondary">
                            </form>
                        </div>
                        <div class="w-full grid grid-cols-1 md:grid-cols-2 space-x-2">
                            @foreach($posts as $post)
                            <div class="col-span-1 p-2 lg:p-8 flex space-x-2 items-center mb-5 bg-gradient-to-b from-secondary to-primary rounded-3xl">
                                <div class="w-1/3 aspect-[4/3] overflow-hidden rounded-xl transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/'. $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="w-full h-full transition duration-300 ease-in-out">
                                </div>
                                <div class="w-3/4 flex flex-col justify-between h-full space-y-3">
                                    <a href="/blogs/{{ $post->slug }}" class="text-gray-200 hover:text-white font-semibold line-clamp-2 capitalize">{{ $post->title }}</a>
                                    <p class="text-sm text-gray-200">{{ $post->updated_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="w-full justify-center items-center">
                            {{ $posts->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/3">
                {{-- banner --}}
                <div class="w-full rounded-xl relative mb-10">
                    <img src="{{ asset('images/bg6.webp') }}" alt="" class="w-full h-full object-cover rounded-xl">
                    <div class="absolute inset-0 flex flex-col px-3 lg:px-10 justify-center items-center">
                        <img src="{{ asset('icons/icon-black.png') }}" alt="" class="w-28">
                        <p class="text-center font-semibold text-gray-600 mt-2 lg:mt-5 text-sm lg:text-base">Hello, I'm Web Programmer and Developer, based in Indonesia with more than 2years++ experiences.</p>
                        <div class="flex space-x-5 text-gray-600 mt-3">
                            <a href="https://www.facebook.com/kerelka" target="_blank" class="hover:text-gray-900"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="hover:text-gray-900"><i class="fa-brands fa-twitter"></i></a>
                            <a href="https://www.instagram.com/kerelkh/" target="_blank" class="hover:text-gray-900"><i class="fa-brands fa-instagram-square"></i></a>
                        </div>
                    </div>
                </div>
                {{-- category --}}
                <div class="w-full rounded-xl bg-gradient-to-b from-secondary to-primary mb-10 px-10 py-5">
                    <h3 class="text-xl font-semibold text-center text-white mb-8 uppercase">Explore Topics <span class="pl-2 text-blue-500"><i class="fa-solid fa-clipboard-list"></i></span></h3>
                    <div class="flex flex-col space-y-4">
                        @foreach($categories as $cat)
                        <div class="pb-3 flex justify-between">
                            <a href="/blogs/?category={{ $cat->category_name }}" class="text-gray-200 hover:text-white flex font-semibold"><span class="pr-3 text-blue-500"><i class="fa-solid fa-caret-right"></i></span> {{ $cat->category_name }}</a>
                            <p class="text-gray-200">({{ $cat->getPost->where('status_id', 2)->count() }})</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- newsletter --}}
                <div class="w-full rounded-xl bg-gradient-to-b from-secondary to-primary mb-10 px-10 py-5 flex flex-col items-stretch">
                    <h3 class="text-xl font-semibold text-center text-white mb-8 uppercase">Newsletter <span class="pl-2 text-blue-500"><i class="fa-solid fa-envelope-open-text"></i></span></h3>
                    <p class="text-gray-200 font-semibold text-center lg:text-xl mb-5">Subscribe to get Fresh News</p>
                    @if(session('message'))
                    <p class="text-sm p-2 text-green-600 bg-green-200 text-center">{{ session('message') }}</p>
                    @endif
                    <form method="POST" action="{{ route('subscribe') }}">
                        @csrf
                        <input type="email" name="email" id="email" placeholder="Email address" autocomplete="off" class="text-center w-full p-2 rounded-lg outline-none focus:ring-2 focus:ring-secondary bg-primary placeholder:italic text-gray-200">
                        @error('email')
                        <span class="w-full mx-auto text-xs text-center text-red-600 bg-red-200">{{ $message }}</span>
                        @enderror
                        <button class="w-full bg-blue-500 hover:bg-blue-700 transition p-3 rounded-lg mt-3 text-sm lg:text-base">SIGNUP</button>
                    </form>

                </div>
                {{-- banner --}}
                <div class="w-full overflow-hidden mb-10">
                    <img src="{{ asset('images/banner2.jpg') }}" alt="" class="object-cover">
                </div>

                {{-- map --}}
                <div class="w-full rounded-xl mb-10 px-3 lg:px-10 py-5 flex flex-col items-stretch">
                    <h3 class="text-xl font-semibold text-center text-white mb-8 uppercase">Map <span class="pl-2 text-blue-500"><i class="fa-solid fa-map-location-dot"></i></span></h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d127416.07358157719!2d102.58719189999997!3d-3.6438788999999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1650218270710!5m2!1sid!2sid" class="w-full h-[280px]" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

    </div>
    @include('components.footer')


    <script>
        function toggleMenu() {
            let sideEl = document.getElementById('sidenav');
            sideEl.classList.toggle('w-0');
            sideEl.classList.toggle('w-60');
        }

        function togglePopularRecent(i) {
            let popularEl = document.getElementById('popular');
            let recentEl = document.getElementById('recent');
            let btnPopularEl = document.getElementById('btnPopular');
            let btnRecentEl = document.getElementById('btnRecent');

            if(i == 'popular'){
                popularEl.classList.remove('hidden');
                recentEl.classList.add('hidden');
                btnPopularEl.classList.remove('text-gray-400');
                btnPopularEl.classList.add('text-white');
                btnRecentEl.classList.remove('text-white');
                btnRecentEl.classList.add("text-gray-400");

            }else{
                popularEl.classList.add('hidden');
                recentEl.classList.remove('hidden');
                btnRecentEl.classList.remove('text-gray-400');
                btnRecentEl.classList.add('text-white');
                btnPopularEl.classList.remove('text-white');
                btnPopularEl.classList.add("text-gray-400");
            }
        }
    </script>
</body>

</html>
