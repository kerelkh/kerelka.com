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

    {{-- sidenav --}}
    <div id="sidenav" class="transition-all duration-300 ease-in-out fixed top-0 bottom-0 right-0 w-0 z-50 overflow-hidden bg-white border-l border-gray-300">
        <button onclick="toggleMenu()" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800"><i class="fa-solid fa-x"></i></button>
        <div class="mt-16 flex flex-col items-stretch">
            <a href="/" class="py-2 px-4 first-letter:uppercase border-b border-gray-300 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500 text-sm md:text-lg hover:text-gray-800"><i class="fa-solid fa-caret-right"></i> Home</a>
            <a href="/blogs" class="py-2 px-4 first-letter:uppercase border-b border-gray-300 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500 text-sm md:text-lg hover:text-gray-800"><i class="fa-solid fa-caret-right"></i> Blogs</a>
            <a href="/aboutme" class="py-2 px-4 first-letter:uppercase border-b border-gray-300 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500 text-sm md:text-lg hover:text-gray-800"><i class="fa-solid fa-caret-right"></i> About me</a>
            <a href="/projects" class="py-2 px-4 first-letter:uppercase border-b border-gray-300 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500 text-sm md:text-lg hover:text-gray-800"><i class="fa-solid fa-caret-right"></i> Projects</a>
            <a href="/designs" class="py-2 px-4 first-letter:uppercase border-b border-gray-300 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500 text-sm md:text-lg hover:text-gray-800"><i class="fa-solid fa-caret-right"></i> Design</a>
        </div>
    </div>
    <div id="app" class="px-1 sm:px-6 xl:px-24 text-gray-200 font-sans">
        {{-- nav top --}}
        <div class="py-1 md:py-3 lg:py-6 flex justify-between items-center">
            <div class="w-full md:w-fit flex md:space-x-10 justify-between items-center">
                <div class="w-32">
                    <a href="/" class="block">
                        <img src="{{ asset('icons/icon-black.png') }}" alt="Logo" class="object-cover">
                    </a>
                </div>
                <div class="hidden md:flex justify-center items-center space-x-5">
                    <a href="/aboutme" class="bg-gradient-to-br from-blue-500 to-purple-500 py-2 px-5 rounded-2xl">About me</a>
                    <a href="/blogs" class="text-gray-500 font-semibold hover:text-gray-800">Blogs</a>
                    <a href="/projects" class="text-gray-500 font-semibold hover:text-gray-800">Projects</a>
                    <a href="/designs" class="text-gray-500 font-semibold hover:text-gray-800">Designs</a>
                </div>
                <div>
                    <button onclick="toggleMenu()" class="md:hidden text-2xl text-gray-800 p-2"><i class="fa-solid fa-bars"></i></button>
                </div>
            </div>
            <div class="hidden md:flex space-x-10 items-center text-gray-600">
                <a href="https://www.facebook.com/kerelka" target="_blank" class="animate-bounce hover:text-gray-900"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="animate-bounce hover:text-gray-900"><i class="fa-brands fa-twitter"></i></a>
                <a href="https://www.instagram.com/kerelkh/" target="_blank" class="animate-bounce hover:text-gray-900"><i class="fa-brands fa-instagram-square"></i></a>
            </div>
        </div>

        <div class="py-6 flex">
            <div class="w-2/3 lg:aspect-video hidden md:flex py-5 pr-5 overflow-hidden rounded-3xl">
                @if($newestPost != null)
                <div class="w-full h-full relative rounded-3xl overflow-hidden group transition duration-500 ease-in-out hover:ring-4">
                    <img src="{{ asset('storage/' . $newestPost->thumbnail) }}" alt="hightlight" class="group-hover:scale-125 transition duration-500 ease-in-out w-full h-full">
                    <div class="absolute inset-0 flex flex-col space-y-5 justify-end items-start p-10 bg-black/40">
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
                <div class="border border-gray-200 rounded-xl px-2 md:px-10 py-5 flex flex-col">
                    <div class="flex justify-between items-center mb-6">
                        <button id="btnPopular" onclick="togglePopularRecent('popular')" class="outline-none rounded-2xl py-1 px-4 text-gray-200 bg-gradient-to-br border hover:bg-gradient-to-br from-blue-500 to-purple-500  hover:text-gray-200">Popular</button>
                        <button id="btnRecent" onclick="togglePopularRecent('recent')" class="outline-none rounded-2xl py-1 px-4 text-gray-400 border hover:bg-gradient-to-br from-blue-500 to-purple-500 hover:text-gray-200 ">Recent</button>
                    </div>
                    @if($mostViewPosts != null)
                    <div id="popular">
                        @foreach($mostViewPosts as $post)
                        <div class="flex space-x-2 py-2 border-b border-gray-300">
                            <div class="w-12 md:w-20 aspect-square rounded-full overflow-hidden">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="w-3/4 flex flex-col justify-between">
                                <a href="blogs/{{ $post->slug }}" class="text-gray-600 hover:text-gray-800">
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
                        <div class="flex space-x-2 py-2 border-b border-gray-300">
                            <div class="w-12 md:w-20 aspect-square rounded-full overflow-hidden">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="w-full h-full object-cover">
                            </div>
                            <div class="w-3/4 flex flex-col justify-between">
                                <a href="blogs/{{ $post->slug }}" class="text-gray-600 hover:text-gray-800">
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
                <h1 class="text-xl lg:text-3xl font-semibold text-gray-800 mb-6">Editor's Pick <span class="text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500"><i class="fa-solid fa-star"></i></span></h1>
                <div class="w-full p-4 lg:p-8 border border-gray-300 rounded-3xl mb-5 lg:mb-10">
                    <div class="flex flex-col lg:flex-row items-start">
                        @if($randomPosts != null)
                            <div class="w-full lg:w-1/2 lg:pr-2 mb-5 lg:mb-0">
                                <div class="w-full aspect-video rounded-3xl overflow-hidden relative group hover:ring-4 hover:scale-95 transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/' . $randomPosts[0]->thumbnail) }}" alt="thumbnail {{ $randomPosts[0]->title }}" class="w-full h-full group-hover:scale-110 transition duration-300 ease-in-out rounded-2xl">
                                    <div class="absolute inset-0 bg-black/40 p-5">
                                        <a href="/blogs?category={{ $randomPosts[0]->getCategory->category_name }}" class="bg-gradient-to-br from-blue-500 to-purple-500 py-1 px-4 rounded-2xl">{{ $randomPosts[0]->getCategory->category_name }}</a>
                                    </div>
                                </div>
                                <div class="my-5 flex space-x-4 items-center">
                                    <div class="w-10 h-10 rounded-full overflow-hidden">
                                        <img src="{{ asset('images/writer.jpg') }}" alt="author" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-gray-400 text-sm">{{ $randomPosts[0]->author }} {{ $randomPosts[0]->updated_at->format('d M Y') }}</p>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <a href="/blogs/{{ $randomPosts[0]->slug }}" class="line-clamp-3 font-semibold text-gray-800 text-lg">{{ $randomPosts[0]->title }}</a>
                                    <p class="text-gray-400 text-sm line-clamp-4">{{ $randomPosts[0]->description }}</p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/2 lg:pl-2">
                                <div class="flex flex-col space-y-5 divide-y-2">
                                    @foreach($randomPosts as $post)
                                        @if($loop->index != 0)
                                            <div class="flex space-x-2 py-2 lg:py-0 lg:p-3">
                                                <div class="w-1/3 aspect-[4/3] rounded-xl overflow-hidden">
                                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="w-full h-full object-cover">
                                                </div>
                                                <div class="w-2/3 flex flex-col space-y-4">
                                                    <a href="/blogs/{{ $post->slug }}" class="font-semibold line-clamp-2 text-gray-600 hover:text-gray-800">{{ $post->title }}</a>
                                                    <p class="text-sm text-gray-400">{{ $post->updated_at->format('d M Y') }}</p>
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
                <h1 class="text-xl lg:text-3xl font-semibold text-gray-800 mb-6">Trending <span class="text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500"><i class="fa-solid fa-fire"></i></span></h1>
                <div class="w-full p-2 lg:p-8 border border-gray-300 rounded-3xl mb-10">
                    <div class="flex flex-col space-y-8">
                        @if($mostViewPosts != null)
                        <div class="w-full flex flex-col lg:flex-row space-y-5 lg:space-y-0 items-start">
                            <div class="w-full lg:w-1/2 lg:pr-2">
                                <div class="w-full aspect-video rounded-3xl overflow-hidden relative group hover:scale-95 hover:ring-4 transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/' . $mostViewPosts[0]->thumbnail) }}" alt="Thumbnail {{ $mostViewPosts[0]->title }}" class="w-full h-full group-hover:scale-110 transition duration-300 ease-in-out rounded-2xl object-cover">
                                    <div class="absolute inset-0 bg-black/40 p-5">
                                        <a href="/blogs?category={{ $mostViewPosts[0]->getCategory->category_name }}" class="bg-gradient-to-br from-blue-500 to-purple-500 py-1 px-4 rounded-2xl">{{ $mostViewPosts[0]->getCategory->category_name }}</a>
                                    </div>
                                </div>
                                <div class="my-5 flex space-x-4 items-center">
                                    <div class="w-10 h-10 rounded-full overflow-hidden">
                                        <img src="{{ asset('images/writer.jpg') }}" alt="author" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-gray-400 text-sm">{{ $mostViewPosts[0]->author }} {{ $mostViewPosts[0]->updated_at->format('d M Y') }}</p>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <a href="/blogs/{{ $mostViewPosts[0]->slug }}" class="line-clamp-3 font-semibold text-gray-800 text-lg">{{ $mostViewPosts[0]->title }}</a>
                                    <p class="text-gray-400 text-sm line-clamp-4">{{ $mostViewPosts[0]->description }}</p>
                                </div>
                            </div>
                            @if($mostViewPosts->count() > 1)
                            <div class="w-full lg:w-1/2 lg:pr-2">
                                <div class="w-full aspect-video rounded-3xl overflow-hidden relative group hover:scale-95 hover:ring-4 transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/' . $mostViewPosts[1]->thumbnail) }}" alt="Thumbnail {{ $mostViewPosts[1]->title }}" class="w-full h-full group-hover:scale-110 transition duration-300 ease-in-out rounded-2xl object-cover">
                                    <div class="absolute inset-0 bg-black/40 p-5">
                                        <a href="/blogs?=categories={{ $mostViewPosts[1]->getCategory->category_name }}" class="bg-gradient-to-br from-blue-500 to-purple-500 py-1 px-4 rounded-2xl">{{ $mostViewPosts[1]->getCategory->category_name }}</a>
                                    </div>
                                </div>
                                <div class="my-5 flex space-x-4 items-center">
                                    <div class="w-10 h-10 rounded-full overflow-hidden">
                                        <img src="{{ asset('images/writer.jpg') }}" alt="author" class="w-full h-full object-cover">
                                    </div>
                                    <p class="text-gray-400 text-sm">{{ $mostViewPosts[1]->author }} {{ $mostViewPosts[1]->updated_at->format('d M Y') }}</p>
                                </div>
                                <div class="flex flex-col space-y-2">
                                    <a href="/blogs/{{ $mostViewPosts[1]->slug }}" class="line-clamp-3 font-semibold text-gray-800 text-lg">{{ $mostViewPosts[1]->title }}</a>
                                    <p class="text-gray-400 text-sm line-clamp-4">{{ $mostViewPosts[1]->description }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endif
                        <div class="w-full">
                            <form method="GET">
                                <input type="search" name="keyword" id="keyword" placeholder="Search..." class="w-full p-2 rounded-xl outline-none focus:ring-2 border border-gray-400 placeholder:italic text-sm text-gray-800">
                            </form>
                        </div>
                        <div class="w-full flex flex-wrap">
                            @foreach($posts as $post)
                            <div class="w-full lg:w-1/2 p-2 flex space-x-2 items-center mb-5">
                                <div class="w-1/3 aspect-[4/3] overflow-hidden rounded-xl group hover:ring-2 hover:scale-95 transition duration-300 ease-in-out">
                                    <img src="{{ asset('storage/'. $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="w-full h-full group-hover:scale-110 transition duration-300 ease-in-out">
                                </div>
                                <div class="w-3/4 flex flex-col justify-between h-full space-y-3">
                                    <a href="/blogs/{{ $post->slug }}" class="text-gray-600 hover:text-gray-800 font-semibold line-clamp-2">{{ $post->title }}</a>
                                    <p class="text-sm text-gray-400">{{ $post->updated_at->format('d M Y') }}</p>
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
                <div class="w-full rounded-xl border border-gray-300 relative mb-10">
                    <img src="{{ asset('images/bg6.jpg') }}" alt="" class="w-full h-full object-cover rounded-xl">
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
                <div class="w-full rounded-xl border border-gray-300 mb-10 px-10 py-5">
                    <h3 class="text-xl lg:text-2xl font-semibold text-center text-gray-800 mb-8">Explore Topics <span class="pl-2 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500"><i class="fa-solid fa-clipboard-list"></i></span></h3>
                    <div class="flex flex-col space-y-4">
                        @foreach($categories as $cat)
                        <div class="pb-3 border-b border-gray-300 flex justify-between">
                            <a href="/blogs/?category={{ $cat->category_name }}" class="text-gray-600 hover:text-gray-800 flex font-semibold"><span class="pr-3 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500"><i class="fa-solid fa-caret-right"></i></span> {{ $cat->category_name }}</a>
                            <p class="text-gray-400">({{ $cat->getPost->where('status_id', 2)->count() }})</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="w-full rounded-xl border border-gray-300 mb-10 px-10 py-5 flex flex-col items-stretch">
                    <h3 class="text-xl lg:text-2xl font-semibold text-center text-gray-800 mb-8">Newsletter <span class="pl-2 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500"><i class="fa-solid fa-envelope-open-text"></i></span></h3>
                    <p class="text-gray-600 font-semibold text-center lg:text-xl mb-5">Subscribe to get Fresh News</p>
                    @if(session('message'))
                    <p class="text-sm p-2 text-green-600 bg-green-200 text-center">{{ session('message') }}</p>
                    @endif
                    <form method="POST" action="{{ route('subscribe') }}">
                        @csrf
                        <input type="email" name="email" id="email" placeholder="Email address" autocomplete="off" class="text-center w-full p-2 rounded-lg outline-none border border-gray-300 focus:ring-2 placeholder:italic text-gray-800">
                        @error('email')
                        <span class="w-full mx-auto text-xs text-center text-red-600 bg-red-200">{{ $message }}</span>
                        @enderror
                        <button class="w-full bg-gradient-to-br from-blue-500 to-purple-500 p-3 rounded-lg mt-3 text-sm lg:text-base">SIGNUP</button>
                    </form>
                    
                </div>
                <div class="w-full overflow-hidden mb-10">
                    <img src="{{ asset('images/banner2.jpg') }}" alt="" class="object-cover">
                </div>
                <div class="w-full rounded-xl border border-gray-300 mb-10 px-3 lg:px-10 py-5 flex flex-col items-stretch">
                    <h3 class="text-xl lg:text-2xl font-semibold text-center text-gray-800 mb-8">Map <span class="pl-2 text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500"><i class="fa-solid fa-map-location-dot"></i></span></h3>
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
                btnPopularEl.classList.add('text-gray-200', 'bg-gradient-to-br');
                btnRecentEl.classList.remove('text-gray-200', 'bg-gradient-to-br');
                btnRecentEl.classList.add("text-gray-400");
                
            }else{
                popularEl.classList.add('hidden');
                recentEl.classList.remove('hidden');
                btnRecentEl.classList.remove('text-gray-400');
                btnRecentEl.classList.add('text-gray-200', 'bg-gradient-to-br');
                btnPopularEl.classList.remove('text-gray-200', 'bg-gradient-to-br');
                btnPopularEl.classList.add("text-gray-400");
            }
        }
    </script>
</body>

</html>
