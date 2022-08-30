@extends('layouts.index')

@section('title')
  <title>{{ $page }} - KerelKA</title>
@endsection

@section('content')
<div class="flex justify-center items-center flex-col space-y-3 mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48 bg-black/20 py-10 bg-cover bg-center bg-no-repeat mb-5" style="background-image:url('images/bg-design.jpg')">
  <h1 class="text-4xl md:5xl lg:text-6xl font-semibold">Projects.</h1>
  <p class="text-sm md:text-lg lg:text-xl italic font-semibold text-gray-600">See the Beauty of Design</p>
</div>

<div class="border-t border-gray-300 py-3 flex flex-col-reverse sm:flex-row justify-between items-stretch md:items-center mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
  <form>
    <div class="flex space-x-2 items-center py-2 px-3 bg-white border border-gray-300 rounded-lg">
      <label for="search"><i class="fa-solid fa-magnifying-glass"></i></label>
      <input type="search" name="keyword" id="keyword" placeholder="search" value="{{ $keyword }}" class="placeholder:italic bg-transparent outline-none">
    </div>
  </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-4 gap-4 mx-2 my-10">
  @forelse($projects as $project)
  <div class="max-w-[400px] aspect-[5/6] overflow-hidden text-sm mb-4 pb-5">
    <a href="/projects/{{ $project->slug }}">
      <div class="w-full h-4/6 overflow-hidden rounded-lg group hover:shadow-lg transition-all duration-300 ease-in-out hover:ring-4 hover:scale-95 relative">
        <img src="{{ asset('storage/' . $project->image) }}" alt="thumbnail {{ $project->title }}" class="w-full h-full group-hover:scale-110 transition duration-500 ease-in-out">
      </div>
    </a>
    <div class="sm:px-5 py-3 flex space-x-4 items-center text-gray-400">
      <div class="w-8 h-8 overflow-hidden rounded-full">
        <img src="{{ asset('images/writer.jpg') }}" alt="author" class="w-full h-full ">
      </div>
      <p>{{ $project->author }}</p>
      <p>{{ $project->updated_at->format('d M Y') }}</p>
    </div>
    <div class="w-full">
      <a href="/projects/{{ $project->slug }}" class='firest-letter:uppercase font-semibold sm:px-5 line-clamp-1 md:line-clamp-2 text-xl'>{{ $project->title }}</a>
      <p class="sm:px-5 line-clamp-1 lg:line-clamp-2 text-gray-400">{{ $project->description }}</p>
    </div>
  </div>
  @empty
    <p class="text-lg text-center w-full">Tidak ada project terkait</p>
  @endforelse
  @if($projects != null)
  <div class="w-full col-span-full flex justify-end">
    {{ $projects->withQueryString()->links() }}
  </div>
  @endif
</div>
@endsection
