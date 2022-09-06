@extends('admin.layouts.index')

@section('content')
  <div class="w-full h-full overflow-y-auto py-4 px-10">
    @if(session('message'))
    <p class="bg-green-200 text-green-800 p-2 flex justify-between items-center mb-4" id="notice">{{ session('message') }}</p>
    @endif
    @if(session('error'))
    <p class="bg-red-200 text-red-800 p-2 flex justify-between items-center mb-4" id="notice">{{ session('error') }}</p>
    @endif
    <div class="flex space-x-12 items-center mb-2 p-2 text-gray-200">
      <h1 class="text-3xl">Edit</h1>
      <p class="text-sm py-2 px-5 rounded-full bg-[#2A2B4A]">{{ now()->format('Y/m/d') }}</p>
    </div>
    <div class="flex items-start justify-between p-2">
      <form action="/posts/{{ $post->slug }}" method="POST" class="w-3/4" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="id" value="{{ $post->id }}">
        <div class="mb-6 flex space-x-10 items-start justify-between">
          <label for="title" class="text-gray-200 font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Title</label>
          <input type="text" name="title" id="title" value="{{ $post->title }}" required placeholder="Title..." class="w-3/4 placeholder:italic p-2 outline-none text-gray-200 bg-[#2A2B4A]">
        </div>
        <div class="mb-6 flex space-x-10 items-start justify-between">
          <label for="author" class="text-gray-200 font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Author</label>
          <input type="text" name="author" id="author" value="{{ $post->author }}" required placeholder="Author..." class="w-3/4 placeholder:italic p-2 outline-none text-gray-200 bg-[#2A2B4A]">
        </div>
        <div class="mb-6 flex space-x-10 items-start justify-between">
          <label for="description" class="text-gray-200 font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Description</label>
          <textarea name="description" id="description" required style="resize:none;" placeholder="Description..." class="w-3/4 placeholder:italic p-2 outline-none text-gray-200 bg-[#2A2B4A]" cols="100" rows="">{{ $post->description }}</textarea>
        </div>
        <div class="mb-6 flex space-x-10 items-start justify-between">
          <label for="status" class="text-gray-200 font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Status</label>
          <select name="status" id="status" class="w-3/4 p-2 outline-none text-gray-200 bg-[#2A2B4A]  rounded-lg">
            @foreach($status as $stat)
            <option value="{{ $stat->id }}" @if($post->status_id == $stat->id) selected @endif>{{ $stat->status }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-6 flex space-x-10 items-start justify-between">
          <label for="status" class="text-gray-200 font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Category</label>
          <select name="category" id="category" class="w-3/4 p-2 outline-none text-gray-200 bg-[#2A2B4A]  rounded-lg">
            @foreach($categories as $category)
            <option value="{{ $category->id }}" @if($post->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-6 flex space-x-10 items-start justify-between">
          <label for="thumbnail" class="text-gray-200 font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Thumbnail</label>
          <div class="flex flex-col w-3/4">
            <div class="w-1/2 rounded-lg overflow-hidden justify-center items-center">
              <img id="tempImg" src="{{ asset('images/sample-image.png') }}" alt="sample-images" class="w-full object-cover">
            </div>
            <div class="w-1/2 flex flex-col justify-center items-center">
              <input type="file" name="thumbnail" id="thumbnail" class="text-sm text-gray-200
              file:mr-4 file:py-2
              file:rounded-full file:border-0
              file:text-sm file:font-semibold
              file:bg-[#2A2B4A] file:text-gray-200
              hover:file:bg-[#030306]"
              onchange="onImageChange()"
              accept="image/png, image/gif, image/jpeg, image/webp"
              >
              @if($post->thumbnail)
                <span class="text-red-800 text-sm">* {{ $post->thumbnail }}</span>
              @endif
            </div>
          </div>
        </div>
        <div class="mb-6 flex flex-col space-y-5">
          <label for="post" class="text-gray-200 font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Post</label>
          <textarea name="post" id="post" cols="30" rows="10" required class="w-3/4">{{ $post->post }}</textarea>
        </div>
        <div class="mt-8">
          <button type="submit" class="transition-all ease-in-out w-full text-white py-2 rounded hover:shadow-lg bg-violet-700 hover:bg-violet-900">Save Post</button>
        </div>
      </form>
      <button onclick="togglePopUp()" class="w-fith-fit p-3 rounded flex items-center gap-2 text-lg bg-red-800 text-gray-200 hover:bg-red-200 hover:text-red-800"><i class="fa-solid fa-trash-can"></i>Delete</button>
    </div>
  </div>

  <div id="popup" class="hidden fixed inset-0 justify-center items-center bg-black/50">
    <div class="flex flex-col justify-center items-center bg-white py-5 px-10">
      <p class="my-5 text-red-800 text-5xl">
        <i class="fa-solid fa-circle-exclamation"></i>
      </p>
      <p class="text-red-800 text-lg">Are you sure want to delete this post ?</p>
      <div class="flex justify-center gap-5 w-full">
        <form action="/posts/{{ $post->slug }}" method="POST">
          @csrf
          @method('delete')
          <button type="submit" class="bg-gray-200 rounded py-3 px-5 hover:bg-gray-400 text-lg">yes</button>
        </form>
        <button onclick="togglePopUp()" class="bg-green-200 hover:bg-green-400 text-green-700 hover:text-green-900 py-3 px-5 text-lg rounded">No</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.tiny.cloud/1/89p3paxydb26po9pxugvevt7a94eaoqsk6zklc7jai8mlh4x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
      tinymce.init({
        selector: '#post',
    });


    function togglePopUp() {
      let popUp = document.getElementById('popup');

      popUp.classList.toggle('hidden');
      popUp.classList.toggle('flex');
    }
  </script>

@endsection
