@extends('admin.layouts.index')

@section('content')
  <div class="w-full h-full overflow-y-auto py-4 px-10 text-gray-200">
    <div class="flex space-x-12 items-center mb-5 ">
      <h1 class="text-3xl">Blogs</h1>
      <p class="text-sm py-2 px-5 rounded-full bg-[#2A2B4A]">{{ now()->format('Y/m/d') }}</p>
    </div>
    @if(session('message'))
    <p class="bg-green-200 text-green-700 py-1 px-2 mb-5">{{ session('message') }}</p>
    @endif
    @if(session('error'))
    <p class="bg-green-200 text-green-700 py-1 px-2 mb-5">{{ session('error') }}</p>
    @endif
    <button data-aos="fade-up" onclick="toggleNewPost()" class="transition-all p-2 flex justify-center items-center gap-2 bg-[#2A2B4A] rounded-lg border " >
      <i class="fa-solid fa-file-circle-plus"></i> Create New Post</button>

    {{-- search --}}
    <div data-aos="fade-left" class="flex justify-end items-center my-4">
      <form method="GET" class="flex justify-center items-center gap-3">
        <select name="status" id="status" name="status" class="bg-[#2A2B4A] text-gray-400 p-2 rounded-lg">
          <option value="all" @if($selectedStatus == 'all') selected @endif>All</option>
          @foreach($statuses as $stat)
          <option value="{{ $stat->id }}" @if($selectedStatus == $stat->id) selected @endif>{{ $stat->status }}</option>
          @endforeach
        </select>
        <input type="search" id="keyword" name="keyword" placeholder="search..." class="p-2 bg-[#2A2B4A] rounded-lg text-sm w-60" value="@if($keyword){{ $keyword }}@endif">
        <button type="submit" class="py-2 px-4 rounded-lg bg-[#2A2B4A]"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
    </div>
    {{-- end of search --}}

    {{-- data posts --}}
    <div id="dataPosts" data-aos="fade-up" class="flex flex-col justify-center items-stretch">
      <table>
        <thead>
          <tr class="bg-[#2A2B4A] text-gray-400 p-2 text-sm text-center border-b border-gray-400">
            <th class="p-2">No</th>
            <th class="p-2">Thumbnail</th>
            <th class="p-2">Title</th>
            <th class="p-2">Author</th>
            <th class="p-2">Created at</th>
            <th class="p-2">Updated at</th>
            <th class="p-2">Action</th>
          </tr>
        </thead>
        <tbody>
          @if($posts->count() == 0)
            <tr class="bg-[#2A2B4A] text-gray-400 p-2 text-sm text-center">
              <td colspan="7" class="p-4 text-lg">No Data Found</td>
            </tr>
          @else
            @foreach($posts as $post)
            <tr class="bg-[#2A2B4A] text-gray-400 p-2 text-sm text-center">
              <td class="p-2">{{ $loop->index+1 }}</td>
              <td class="w-48 aspect-video overflow-hidden p-2">
                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }} thumbnail" class="w-full h-full object-cover">
              </td>

              <td class="p-2 text-left"><a href="/blogs/{{ $post->slug }}" class="text-violet-400"><i class="fa-solid fa-up-right-from-square"></i> {{ $post->title }}</a></td>
              <td class="p-2">{{ $post->author }}</td>
              <td class="p-2">{{ $post->created_at }}</td>
              <td class="p-2">{{ $post->updated_at }}</td>
              <td class="p-2">
                <a href="/admin/blog/{{ $post->slug }}" class="text-green-500"><i class="fa-solid fa-pen-to-square"></i></a>
              </td>
            </tr>
            @endforeach
          @endif
        </tbody>
      </table>
      <div class="flex justify-end mt-2">
        {{ $posts->withQueryString()->links('vendor.pagination.dark-manual') }}
      </div>

    </div>
  </div>

  <div id="newpost" class="transition-all fixed top-0 left-0 right-0 h-0 bg-[#1B203D] overflow-y-scroll flex flex-col items-center">
    <button onclick="toggleNewPost()" class="text-4xl text-gray-200 absolute top-5 right-5 transition-all ease-in-out scale-90 hover:scale-100">
      <i class="fa-solid fa-x"></i>
    </button>

    {{-- wyswyg --}}
    <form action="/posts" method="POST" class="w-2/4 mt-20 text-gray-200" enctype="multipart/form-data">
      @csrf
      <div class="mb-6 flex flex-col space-y-4">
        <label for="title" class=" font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="Title..." class="placeholder:italic p-2 outline-none bg-[#2A2B4A]">
      </div>
      <div class="mb-6 flex flex-col space-y-4">
        <label for="author" class=" font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Author</label>
        <input type="text" name="author" id="author" value="{{ old('author') }}" required placeholder="Author..." class="placeholder:italic p-2 outline-none bg-[#2A2B4A]">
      </div>
      <div class="mb-6 flex flex-col space-y-4">
        <label for="description" class=" font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Description</label>
        <textarea name="description" id="description" value="{{ old('description') }}" required style="resize:none;" placeholder="Description..." class="placeholder:italic p-2 outline-none bg-[#2A2B4A]" cols="100" rows=""></textarea>
      </div>
      <div class="mb-6 flex flex-col space-y-4">
        <label for="thumbnail" class=" font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Thumbnail</label>
        <div class="flex">
          <div class="w-1/2 rounded-lg overflow-hidden justify-center items-center">
            <img id="tempImg" src="{{ asset('images/sample-image.png') }}" alt="sample-images" class="w-full object-cover">
          </div>
          <div class="w-1/2 flex justify-center items-center">
            <input type="file" name="thumbnail" id="thumbnail" class="text-sm text-slate-500
            file:mr-4 file:py-2
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            file:bg-violet-50
            hover:file:bg-violet-100
            cursor-pointer"
            onchange="onImageChange()"
            accept="image/png, image/gif, image/jpeg"
            required>
          </div>
        </div>
      </div>
      <div class="mb-6 flex flex-col space-y-4">
        <label for="post" class=" font-bold py-1 px-3 rounded-lg bg-[#2A2B4A] w-fit">Post</label>
        <textarea name="post" id="post" cols="30" rows="10" class="bg-[#2A2B4A]">{{ old('post') }}</textarea>
      </div>
      <div class="my-8">
        <button type="submit" class="transition-all ease-in-out w-full text-green-500 py-2 rounded hover:shadow-lg bg-[#2A2B4A] hover:bg-[#1B1A17]">Save Post</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.tiny.cloud/1/89p3paxydb26po9pxugvevt7a94eaoqsk6zklc7jai8mlh4x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    //create new post
    const newpostEl = document.getElementById('newpost');

    function toggleNewPost(){
      newpostEl.classList.toggle('h-0');
      newpostEl.classList.toggle('h-screen');
    }

    //testing
    // toggleNewPost()

    //temp images
    const tempImgEl = document.getElementById('tempImg');
    const thumbnailEl = document.getElementById('thumbnail');

    function onImageChange() {
      let reader = new FileReader();
      if(thumbnailEl.files[0]){
        reader.readAsDataURL(thumbnailEl.files[0]);
      }

      reader.onloadend = function() {
        tempImgEl.src = reader.result;
      }
    }

    //tiny mce editor
    tinymce.init({
        selector: 'textarea#post',
    });


    //data tables
    // $(document).ready(function() {
    //     $('#table1').DataTable();
    // } );
  </script>
@endsection
