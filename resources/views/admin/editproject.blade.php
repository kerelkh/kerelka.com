@extends('admin.layouts.index')

@section('content')
<div class="w-full h-full overflow-y-auto py-4 px-10 text-gray-200">
  <div class="flex space-x-12 items-center mb-5">
    <h1 class="text-3xl">Edit Project</h1>
    <p class="text-sm py-2 px-5 rounded-full bg-[#2A2B4A]">{{ now()->format('Y/m/d') }}</p>
    <a href="/designs/{{ $project->slug }}" class="py-2 px-5 text-sm rounded-full bg-[#2A2B4A] hover:bg-blue-300 hover:text-gray-800 underline">Go to {{ $project->title }}</a>
  </div>
  @if(session('message'))
  <p class="bg-green-200 text-green-700 py-1 px-2 mb-5">{{ session('message') }}</p>
  @endif
  @if(session('error'))
  <p class="bg-red-200 text-red-700 py-1 px-2 mb-5">{{ session('error') }}</p>
  @endif
  <div class="w-full">
    <form action="{{ route('admin.project.delete', $project->slug) }}"method="POST" onsubmit="submitForm(event)">
      @csrf
      @method('delete')
      <button type="submit" class="border border-red-500 text-red-500 hover:bg-red-500 hover:text-gray-200 py-3 px-5 rounded">Delete</button>
    </form>
  </div>
  <div>
    <form method="POST" enctype="multipart/form-data" onsubmit="submitForm(event)" class="flex flex-col space-y-5">
      @csrf
      <input type="text" name="title" class="p-2 bg-[#2A2B4A] rounded" placeholder="title" value="{{ $project->title }}">
      <input type="text" name="author" class="p-2 bg-[#2A2B4A] rounded" placeholder="author" value="{{ $project->author }}">
      <textarea name="description" id="description" cols="30" rows="5" class="p-2 bg-[#2A2B4A] rounded" placeholder="description" style="resize: none;">{{ $project->description }}</textarea>
      <div class="flex flex-col space-y-2">
        <input type="file" name="image" id="">
        <a href="{{ asset('storage/' . $project->image) }}" class="text-sm text-blue-500">Click to see image</a>
      </div>
      <div class="flex justify-start item-start">
        <button type="submit" class="bg-green-600 py-3 px-4 hover:bg-green-800">Save</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.tiny.cloud/1/89p3paxydb26po9pxugvevt7a94eaoqsk6zklc7jai8mlh4x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
      tinymce.init({
        selector: '#description',
    });

  function submitForm(e) {
    if(confirm('are you sure want to update this project ?') == false){
      e.preventDefault();
    }
  }
</script>
@endsection
