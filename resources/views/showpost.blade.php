@extends('layouts.index')

@section('title')
  <title>{{ $post->title }}</title>
@endsection

@section('content')
  @auth
    <div class="border p-4 rounded mb-1 md:mb-5 flex justify-between gap-5 items-center mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
      <div>
        <p class="text-gray-400 text-sm italic">Status: {{ $post->getStatus->status }} <br> Created at: {{ $post->created_at }} <br> Updated at: {{ $post->updated_at }}</p>
      </div>
      <a href="/admin/blog/{{ $post->slug }}" class="text-green-600"><i class="fa-solid fa-pen-to-square"></i></a>
    </div>
  @endauth
  <div id="post" class="flex flex-col items-center py-10 mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
    <div class="w-full md:w-[700px] flex justify-start space-x-5 items-center text-gray-400 mb-2 md:mb-5 text-xs md:text-sm lg:text-base">
      <a href="/" class="hover:text-gray-800">Home</a>
      <i class="fa-solid fa-caret-right"></i>
      <a href="{{ $post->slug }}" class="text-gray-700">{{ $post->title }}</a>
    </div>

    <div class="w-full md:w-[700px] flex justify-start sm:space-x-4 items-center text-gray-400 mb-2 md:mb-5 text-xs md:text-sm lg:text-base">
      <div id="avatar" class="hidden sm:block w-12 h-12 rounded-full overflow-hidden">
        <img src="{{ asset('images/writer.jpg') }}" alt="" class="h-full w-full object-cover">
      </div>
      <p class="pr-2 sm:pr-0">{{ $post->author }}</p>
      <p class="pr-2 sm:pr-0">{{ $post->updated_at }}</p>
      <p class="pr-2 sm:pr-0"><span class="text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500"><i class="fa-solid fa-eye"></i></span> ({{ $post->view }})</p>
    </div>

    <div class="w-full md:w-[700px] text-gray-800 mb-5">
      <h1 class="text-lg sm:text-2xl md:text-3xl font-semibold">{{ $post->title }}</h1>
    </div>

    <div class="w-full mb-5 flex">
      <div class="w-full xl:w-5/6 aspect-video md:aspect-[4/2] bg-cover bg-no-repeat bg-center relative" style="background-image: url({{ asset('storage/' .$post->thumbnail) }})">
        <div class="absolute inset-0 bg-black/20 p-2 sm:p-4 md:p-10 flex justify-end items-start">
          <a href="/blogs?category={{ $post->getCategory->category_name }}" class="py-1 px-5 bg-gradient-to-br from-blue-500 to-purple-500 text-gray-200 rounded-xl text-xs sm:text-sm md:text-base">{{ $post->getCategory->category_name }}</a>
        </div>
      </div>
      <div class="hidden xl:w-1/6 xl:flex bg-cover bg-no-repeat bg-center" style="background: url('https://images.unsplash.com/photo-1550895030-823330fc2551?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80')"></div>
    </div>

    <div class="w-full md:w-[700px] pb-5 sm:pb-10 border-b border-gray-300">
      <p class="text-gray-400 text-sm sm:text-base md:text-lg">{{ $post->description }}</p>
    </div>

    <div class="w-full md:w-[700px] py-1 flex space-x-5 mb-5 md:mb-10">
      <a href="#" class="text-gray-400 hover:text-gray-900"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="#" class="text-gray-400 hover:text-gray-900"><i class="fa-brands fa-twitter"></i></a>
      <a href="#" class="text-gray-400 hover:text-gray-900"><i class="fa-brands fa-instagram-square"></i></a>
    </div>

    <div class="w-full md:w-[700px] tracking-wider first-letter:text-5xl text-gray-600 first-letter:float-left first-letter:uppercase pb-10 border-b border-gray-300 mb-5 text-sm sm:text-base md:text-lg">
      {!! $post->post !!}
    </div>

  </div>

@endsection
