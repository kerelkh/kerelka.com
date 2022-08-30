@extends('layouts.index')

@section('title')
  <title>{{ $project->title }}</title>
@endsection

@section('content')
  <div class="flex flex-col space-y-5 items-stretch md:mb-10 mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
    <div class="w-full">
      <div class="w-full md:w-4/6 mx-auto flex justify-start space-x-5 items-center text-gray-400 mb-2 md:mb-5 text-xs md:text-sm lg:text-base">
        <a href="/projects" class="hover:text-gray-800">projects</a>
        <i class="fa-solid fa-caret-right"></i>
        <a href="{{ $project->slug }}" class="text-gray-700 first-letter:uppercase">{{ $project->title }}</a>
      </div>
      <div class="w-full md:w-4/6 sm:mx-auto flex items-center text-gray-400 gap-5 text-xs sm:text-sm md:text-base lg:text-lg">
        <div class="hidden sm:flex w-8 h-8 overflow-hidden rounded-full ring-2 ring-blue-500">
          <img src="{{ asset('images/writer.jpg') }}" alt="author" class="w-full h-full object-cover">
        </div>
        <p>{{ $project->author }}</p>
        <p>{{ $project->updated_at->format('d M Y') }}</p>
      </div>
      <div class="w-full md:w-4/6 sm:mx-auto my-4 text-gray-800 mb-5">
        <h1 class="text-lg sm:text-2xl md:text-3xl font-semibold">{{ $project->title }}</h1>
      </div>
    </div>
    <div class="flex w-full">
      <div class="w-full md:w-5/6 aspect-video md:aspect-[4/2] relative overflow-hidden">
        <img src="{{ asset('storage/'. $project->image) }}" alt="image {{ $project->title }}" class="w-full h-full object-cover">
      </div>
      <div class="hidden md:flex w-1/6 bg-cover bg-no-repeat bg-center" style="background-image: url('https://images.unsplash.com/photo-1550895030-823330fc2551?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80')">
      </div>
    </div>

    <div class="flex w-full flex-col space-y-5">
      <div class="w-4/6 mx-auto mt-5 text-sm sm:text-base md:text-lg">
        <div class="text-gray-600">{!! $project->description !!}</div>
      </div>
    </div>
  </div>

@endsection