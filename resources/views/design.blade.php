@extends('layouts.index')

@section('title')
  <title>{{ $title }} - KerelKA</title>
@endsection

@section('content')
  <div class="flex justify-center items-center flex-col space-y-3 mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48 bg-black/20 py-10 bg-cover bg-center bg-no-repeat mb-5" style="background-image:url('images/bg-design.jpg')">
    <h1 class="text-4xl md:5xl lg:text-6xl font-semibold">Design.</h1>
    <p class="text-sm md:text-lg lg:text-xl italic font-semibold text-gray-600">See the Beauty of Design</p>
  </div>

  <div class="border-t border-gray-300 py-3 flex flex-col-reverse sm:flex-row justify-between items-stretch md:items-center mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
    {{-- search --}}
    <form>
      <div class="flex space-x-2 items-center py-2 px-3 bg-white border border-gray-300 rounded-lg">
        <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
        <input type="search" name="keyword" id="keyword" placeholder="search" value="{{ $keyword }}" class="placeholder:italic bg-transparent outline-none">
      </div>
    </form>

    {{-- action --}}
    <div class="w-full flex justify-start mb-2 sm:mb-0 sm:justify-end items-stretch ">
      <a href="?category=@if($keyword)&keyword={{ $keyword }} @endif" class="py-2 px-4 border border-gray-300 transition duration-300 ease-in-out hover:text-gray-200 hover:bg-gradient-to-br from-blue-500 to-purple-500 @if($category == '' || $category == null)text-gray-200 bg-gradient-to-br @else text-gray-400 @endif">All</a>
      @foreach($designCategories as $cat)
        <a href="?category={{ $cat->category_name }}@if($keyword)&keyword={{ $keyword }} @endif"class="py-2 px-4 border border-gray-300 transition duration-300 ease-in-out hover:text-gray-200 hover:bg-gradient-to-br from-blue-500 to-purple-500 @if($category == $cat->category_name) text-gray-200 bg-gradient-to-br @else text-gray-400 @endif">{{ $cat->category_name }}</a>
      @endforeach
    </div>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-4 gap-4 mx-2 my-10">
    @forelse($designs as $design)
      <div class="max-w-[400px] aspect-[5/6] overflow-hidden text-sm mb-4 pb-5">
        <a href="/designs/{{ $design->slug }}">
        <div class="w-full h-4/6 overflow-hidden rounded-lg group hover:shadow-lg transition-all duration-300 ease-in-out hover:ring-4 hover:scale-95 relative">
          <img src="{{ asset('storage/' . $design->image) }}" alt="" class="w-full h-full group-hover:scale-110 transition duration-500 ease-in-out">
          <div class="absolute inset-0 flex items-start p-4">
            <p class="text-gray-200 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg p-2">{{ $design->getCategory->category_name }}</p>
          </div>
        </div>
      </a>
        <div class="sm:px-5 py-3 flex space-x-4 items-center text-gray-400">
          <div class="w-8 h-8 overflow-hidden rounded-full">
            <img src="{{ asset('images/writer.jpg') }}" alt="" class="w-full h-full ">
          </div>
          <p>{{ $design->author }}</p>
          <p>{{ $design->updated_at->format('d M Y') }}</p>
        </div>
        <div class="w-full">
          <a href="/designs/{{ $design->slug }}" class='firest-letter:uppercase font-semibold sm:px-5 line-clamp-1 md:line-clamp-2 text-xl'>{{ $design->title }}</a>
          <div class="sm:px-5 line-clamp-1 lg:line-clamp-2 text-gray-400">{!!  $design->description  !!}</div>
        </div>
      </div>
    @empty
    <p class="w-full text-center text-lg">Tidak ada design terkait</p>
    @endforelse
    <div class="w-full col-span-full flex justify-end items-center py-5">
      {{ $designs->withQueryString()->links() }}
    </div>
  </div>


@endsection
