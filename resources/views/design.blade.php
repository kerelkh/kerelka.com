@extends('layouts.index')

@section('title')
  <title>{{ $title }} - KerelKA</title>
@endsection

@section('content')
  <div class="flex justify-center flex-col space-y-3 mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48 pb-5 bg-gradient-to-br from-secondary to-primary p-5 rounded-xl">
    <h1 class="text-4xl md:5xl lg:text-6xl font-semibold">Design.</h1>
    <p class="text-sm md:text-lg lg:text-xl italic font-semibold text-gray-600">See the Beauty of Design</p>
  </div>

  <div class="border-t border-gray-300 py-3 flex flex-col-reverse sm:flex-row justify-between items-stretch md:items-center mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
    <form>
      <div class="flex space-x-2 items-center py-2 px-3 bg-secondary border border-gray-400 rounded-lg">
        <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
        <input type="search" name="keyword" id="keyword" placeholder="search" value="{{ $keyword }}" class="placeholder:italic bg-transparent outline-none">
      </div>
    </form>

    {{-- action --}}
    <div class="w-full flex justify-start mb-2 sm:mb-0 sm:justify-end items-stretch gap-2 ">
      <a href="?category=@if($keyword)&keyword={{ $keyword }} @endif" class="rounded-lg py-2 px-4 border border-transparent bg-secondary transition duration-300 ease-in-out hover:text-gray-200 hover:border-blue-900 @if($category == '' || $category == null)text-gray-200 bg-blue-500 @else text-gray-400 @endif">All</a>
      @foreach($designCategories as $cat)
        <a href="?category={{ $cat->category_name }}@if($keyword)&keyword={{ $keyword }} @endif"class="rounded-lg py-2 px-4 border border-transparent hover:border-secondary bg-secondary transition duration-300 ease-in-out hover:text-gray-200 hover:border-blue-900 @if($category == $cat->category_name) text-gray-200 bg-blue-500 @else text-gray-400 @endif">{{ $cat->category_name }}</a>
      @endforeach
    </div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-5 mb-10 mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
    @forelse ($designs as $design)
        <div class="col-span-1">
            <a href="/designs/{{ $design->slug }}" class="group">
                <div class="relative">
                    <img src="{{ asset('storage/' . $design->image) }}" alt="design image {{ $design->title }}" class="w-full aspect-square rounded-lg">
                    <div class="opacity-0 transition duration-500 ease-in-out absolute bottom-0 left-0 right-0 group-hover:opacity-100 bg-gradient-to-b from-transparent to-black/50 py-5">
                        <p class="text-white tracking-wide font-semibold px-2 text-lg capitalize line-clamp-1">{{ $design->title }}</p>
                    </div>
                </div>
                <div class="flex space-x-2 mt-2 items-center justify-between">
                    <div class="flex space-x-2 items-center">
                        <div class="w-8 aspect-square rounded-full border-2 overflow-hidden">
                            <img src="{{ asset('images/writer.webp') }}" alt="author" class="w-full object-cover">
                        </div>
                        <p>{{ $design->author }}</p>
                    </div>
                    <div>
                        <p class='text-xs text-gray-300'>
                        {{ $design->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div>
            <p class="w-full text-sm text-gray-300">Tidak ada design terkait...</p>
        </div>
    @endforelse
    @if($designs != null)
        <div class="w-full col-span-full flex justify-end">
            {{ $designs->withQueryString()->links() }}
        </div>
    @endif
  </div>


@endsection
