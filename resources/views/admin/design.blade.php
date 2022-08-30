@extends('admin.layouts.index')

@section('content')
  <div class="w-full h-full overflow-y-auto py-4 px-10 text-gray-200">
    <div class="flex space-x-12 items-center mb-5">
      <h1 class="text-3xl">Design</h1>
      <p class="text-sm py-2 px-5 rounded-full bg-[#2A2B4A]">{{ now()->format('Y/m/d') }}</p>
      <a href="/designs" class="py-2 px-5 text-sm rounded-full bg-[#2A2B4A] hover:bg-blue-300 hover:text-gray-800 underline">Go to Designs page</a>
    </div>
    @if(session('message'))
    <p class="bg-green-200 text-green-700 py-1 px-2 mb-5">{{ session('message') }}</p>
    @endif
    @if(session('error'))
    <p class="bg-red-200 text-red-700 py-1 px-2 mb-5">{{ session('error') }}</p>
    @endif

    <div class="w-full flex space-x-10 mb-10">
      <div>
        <h1 class="border-b border-gray-300 mb-5">Add Category</h1>
        <form method="post">
          @csrf
          <div class="flex flex-col items-start space-y-2">
            <label for="category_name">Category Name</label>
            <div class="flex items-center space-x-2">
              <input type="text" name="category_name" id="category_name" placeholder="category..." class="p-2 bg-[#2A2B4A] outline-none" required>
              <button type="submit" class="p-2 border border-gray-400 rounded hover:bg-green-500">Add</button>
            </div>
            @error('category_name')
              <span class="text-red-800 bg-red-200 p-2 text-xs">{{ $message }}</span>
            @enderror
          </div>
        </form>
      </div>
      @if($categories != null)
      <div>
        <h1 class="border-b border-gray-300 mb-5">List Categories</h1>
        @foreach($categories as $cat)
        <div class="flex space-x-4">
          <span>{{ $loop->index+1 }}.</span>
          <a href="#">{{ $cat->category_name }}</a>
          <form method="POST" action="design/{{ $cat->category_name }}" onsubmit="confirmationDelete(event)">
            @csrf
            @method('DELETE')
            <button type="submit"  class="text-red-500 text-lg"><i class="fa-solid fa-trash-can"></i></button>
          </form>
        </div>
        @endforeach
      </div>
      @endif
    </div>

    <div class="w-full flex justify-between py-5 items-start border-t border-gray-300">
      <div class="w-1/2 flex flex-col items-start">
        <h1 class="text-gray-200 text-xl mb-5">New Design</h1>
        <form action="{{ route('store.design') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-2">
          @csrf
          <div class="flex flex-col items-start gap-2">
            <label for="title" class="text-gray-400">Title</label>
            <input type="text" name="title" class="py-1 px-2 rounded bg-[#2A2B4A] outline-none @error('title') ring-2 ring-red-400 @enderror">
            @error('title')
            <span class="text-red-500 text-sm">* {{ $message }}</span>
            @enderror
          </div>
          <div class="flex flex-col items-start gap-2">
            <label for="author" class="text-gray-400">Author</label>
            <input type="text" name="author" class="py-1 px-2 rounded bg-[#2A2B4A] outline-none @error('author') ring-2 ring-red-400 @enderror">
            @error('author')
            <span class="text-red-500 text-sm">* {{ $message }}</span>
            @enderror
          </div>
          <div class="flex flex-col items-start gap-2">
            <label for="description" class="text-gray-400">Description</label>
            <textarea name="description" id="description" cols="30" rows="4" class="py-1 px-2 rounded bg-[#2A2B4A] outline-none @error('description') ring-2 ring-red-400 @enderror" style="resize:none"></textarea>
            @error('description')
            <span class="text-red-500 text-sm">* {{ $message }}</span>
            @enderror
          </div>
          <div class="flex flex-col items-start gap-2">
            <label for="category" class="text-gray-400">Category</label>
            <select name="category" id="category" class="py-1 px-2 rounded bg-[#2A2B4A] outline-none" required>
              @foreach($categories as $cat)
              <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="flex flex-col items-start gap-2 text-gray-400">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="text-sm text-slate-500
            file:mr-4 file:py-2
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50
            hover:file:bg-violet-100
            cursor-pointer"
            accept="image/png, image/gif, image/jpeg"
            required>
          </div>
          <button type="submit" class="w-full py-2 px-4 outline-none bg-slate-400 text-gray-800 rounded-lg mt-10 hover:bg-slate-200">Add</button>
        </form>
      </div>
      <div class="w-2/3 flex flex-col space-y-5">
        <h1 class="text-lg pb-2 ">Desings</h1>
        <div class="w-full">
          <form method="GET" class="text-sm flex gap-2">
            <input type="search" name="keyword" id="keyword" placeholder="search..." value="{{ $keyword ?? '' }}" class="p-2 bg-[#2A2B4A] rounded placeholder:italic">
            <button type="submit" class="p-2 rounded border border-gray-300">Search</button>
          </form>
        </div>
        <table class="w-full text-gray-400">
          <thead>
            <tr class="border-b border-gray-400">
              <th>No</th>
              <th>Image</th>
              <th>Title</th>
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="mt-5">
            @foreach($designs as $design)
            <tr class="text-center">
              <td class="p-2">{{ $loop->index + 1 }}</td>
              <td class="w-24 p-2"><img src="{{ asset('storage/' . $design->image) }}" alt="image {{ $design->title }}" class="w-full aspect-video"></td>
              <td class="w-[300px] overflow-hidden p-2"><a href="/designs/{{ $design->slug }}" class="line-clamp-2 first-letter:uppercase">{{ $design->title }}</a></td>
              <td class="p-2">{{ $design->getCategory->category_name }}</td>
              <td class="p-2">
                <a href="/admin/design/{{ $design->slug }}">Edit</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $designs->withQueryString()->links() }}
      </div>
    </div>
  </div>


  <script src="https://cdn.tiny.cloud/1/89p3paxydb26po9pxugvevt7a94eaoqsk6zklc7jai8mlh4x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    function confirmationDelete(e) {
      if(confirm("Are you sure wanna delete this category ?") == false){
        e.preventDefault();
      }
    }

    tinymce.init({
        selector: '#description',
    });


  </script>
@endsection
