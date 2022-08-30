@extends('layouts.index')

@section('title')
  <title>{{ $page }} - Kerelka</title>
@endsection

@section('content')
  <div class="mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
    <div class="w-full overflow-hidden relative mb-4">
      <img src="{{ asset('images/banner1.jpg')}}" alt="banner" class="w-full h-full object-cover">
    </div>
    <div class="w-full flex flex-col md:flex-row flex-wrap divide-y-2 md:divide-x-2 border border-gray-300 mb-2 rounded">
      <a href="/blogs" class="text-sm md:text-base flex py-2 px-4 justify-center items-center hover:bg-gradient-to-br from-blue-400 to-violet-500 transition ease-in-out hover:text-gray-200">All</a>
      @foreach($categories as $category)
      <a href="?category={{ $category->category_name }}@if($keyword != '')&&keyword={{ $keyword }}@endif" class="text-sm md:text-base flex py-2 px-4 justify-center items-center hover:bg-gradient-to-br from-blue-400 to-violet-500 transition ease-in-out hover:text-gray-200">{{ $category->category_name }}</a>
      @endforeach
    </div>

    <div class="w-full mb-2">
      <form method="GET">
        <input type="search" name="keyword" id="keyword" placeholder="search" autocomplete="off" value="{{ $keyword ?? '' }}" class="w-full md:w-fit placeholder:italic outline-none border-gray-300 focus:border-violet-500 border py-1 px-4 rounded">
      </form>
    </div>


    <div class="w-full grid grid-cols-6 gap-5 mb-2">
      <div class="col-span-6 md:col-span-4 py-2 flex flex-col space-y-3">
        @if($category_keyword != '')
          <span class="text-gray-500 italic text-sm">result of category "{{ $category_keyword }}"</span>
        @endif
        @forelse($posts as $post)
        <a href="/blogs/{{ $post->slug }}">
          <div class="flex flex-col sm:flex-row">
            <div class="w-full sm:w-2/4 aspect-video relative overflow-hidden">
              <img src="{{ asset('storage/'. $post->thumbnail) }}" alt="thumbnail {{ $post->title }}" class="scale-110 hover:scale-100 transition duration-300 ease-in-out w-full h-full object-cover">
            </div>
            <div class="w-full sm:w-2/4 px-2 flex flex-col space-y-2">
              <h2 class="text-xl md:text-2xl">{{ $post->title }}</h2>
              <p class="text-xs sm:text-sm text-gray-400"><span class="text-xs text-gray-200 bg-gradient-to-br from-blue-500 to-purple-500 p-1 rounded">{{ $post->getCategory->category_name }}</span> {{ $post->updated_at->format('d M Y') }}</p>
              <p class="text-gray-500 text-xs sm:text-sm w-full sm:w-5/6 line-clamp-5">
                {{ $post->description }}
              </p>
            </div>
          </div>
        </a>
        @empty
        <div class="flex flex-col sm:flex-row">
            <p class="p-5 text-center w-full">Tidak ada artikel terkait</p>
        </div>
        @endforelse
        @if($posts->count() > 0)
          <div class="w-full">
            {{ $posts->withQueryString()->links() }}
          </div>
        @endif
      </div>
      <div class="col-span-6 md:col-span-2 py-2 bg-white shadow-lg p-4 h-fit rounded-lg">
        <h2 class="text-lg mb-2">Artikel lainnya</h2>
        <div class="flex flex-col divide-y-2">
          @foreach($randomPosts as $post)
          <div class="flex space-x-2 py-2">
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
      </div>
    </div>
  </div>
@endsection
