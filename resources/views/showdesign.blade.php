@extends('layouts.index')

@section('title')
  <title>{{ $design->title }}</title>
@endsection

@section('content')
  <div class="grid md:grid-cols-6 mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48 space-x-5">
    <div class="col-span-1 md:col-span-4">
        <div id="design" class="flex flex-col items-center">
            <div class="w-full flex justify-start  space-x-2 items-center text-gray-200 mb-2 md:mb-5 text-xs md:text-sm lg:text-base">
              <a href="/designs" class="hover:text-white">designs</a>
              <i class="fa-solid fa-caret-right"></i>
              <a href="{{ $design->slug }}" class="text-white capitalize">{{ $design->title }}</a>
            </div>
            <div class="text-gray-200 w-full text-xs mb-5 flex space-x-2  rounded-xl">
              <p class="pr-2 sm:pr-0">{{ $design->updated_at }}</p>
            </div>
            <div class="w-full rounded-xl mb-5">
                <div class="w-full text-gray-200 mb-5">
                    <h1 class="text-lg sm:text-xl md:text-2xl font-semibold capitalize">{{ $design->title }}</h1>
                </div>
                <div class="w-full mb-5 flex">
                    <div class="w-full rounded-lg aspect-video md:aspect-[4/2] bg-cover bg-no-repeat bg-center relative" style="background-image: url({{ asset('storage/' . $design->image) }})">
                    </div>
                </div>
            </div>

            <div class="w-full p-5 bg-gradient-to-r from-secondary to-primary ring-1 ring-blue-400/20 rounded-3xl tracking-wide first-letter:text-5xl text-gray-300 first-letter:float-left first-letter:uppercase pb-10 mb-5 text-sm sm:text-base md:text-lg">{!! $design->description  !!}
            </div>
            <div class="w-full py-1 flex space-x-5 mb-5 md:mb-10">
                <a href="#" class="text-gray-200 hover:text-white"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="text-gray-200 hover:text-white"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="text-gray-200 hover:text-white"><i class="fa-brands fa-instagram-square"></i></a>
              </div>
        </div>
    </div>
    <div class="col-span-1 md:col-span-2 h-full overflow-x-hidden p-5">
        <div class="w-full sticky top-0 mx-auto text-gray-400 mb-2 md:mb-5 text-xs md:text-sm lg:text-base px-4">
            <div id="avatar" class="hidden sm:block w-full aspect-square rounded-xl overflow-hidden my-5">
                <img src="{{ asset('images/writer.webp') }}" alt="" class="w-full h-full object-cover">
            </div>
            <div class="w-3/4 px-5">
                <p>design Author</p>
                <p class="mt-2 text-lg text-gray-200">{{ $design->author }}</p>
                <p class="text-sm text-gray-300">@kerelkh</p>
                <p class="mt-2 text-gray-300 text-sm italic">Web Developer, based in Indonesia.</p>
            </div>
        </div>
    </div>
  </div>

@endsection
