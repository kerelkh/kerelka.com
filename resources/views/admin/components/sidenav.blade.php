<div class="transition-all ease-in-out p-3 h-full w-60 shadow flex flex-col space-y-1 bg-[#2A2B4A] text-white overflow-hidden ">
  <a href="/" class="flex justify-center items-center mb-5">
    <img src="{{ asset('icons/brand-icon.png') }}" alt="Images" class="h-10">
  </a>
  <p class="text-gray-400 px-1 py-2">Menu</p>
  <a href="{{ route('admin.dashboard') }}" title="Dashboard" class="flex flex-nowrap items-center gap-5 p-1 hover:shadow-lg hover:bg-violet-700 rounded-lg @if($page == 'Dashboard') bg-violet-700/80  @endif"><i class="fa-solid fa-gauge fa-lg"></i> Dashboard</a>
  <a href="{{ route('admin.blog') }}" title="Blog" class="flex flex-nowrap items-center gap-5 p-1 hover:shadow-lg hover:bg-violet-700 rounded-lg @if($page == 'Blog') bg-violet-700 @endif"><i class="fa-solid fa-blog fa-lg"></i>Blogs</a>
  <a href="{{ route('admin.design') }}" title="Design" class="flex flex-nowrap items-center gap-5 p-1 hover:shadow-lg hover:bg-violet-700 rounded-lg @if($page == 'Design') bg-violet-700 @endif"><i class="fa-solid fa-object-ungroup"></i>Design</a>
  <a href="{{ route('admin.project') }}" title="Project" class="flex flex-nowrap items-center gap-5 p-1 hover:shadow-lg hover:bg-violet-700 rounded-lg @if($page == 'Project') bg-violet-700 @endif"><i class="fa-solid fa-diagram-project"></i>Project</a>
  <a href="{{ route('admin.setting') }}" title="Web Setting" class="flex flex-nowrap items-center gap-5 p-1 hover:shadow-lg hover:bg-violet-700 rounded-lg @if($page == 'Web Setting') bg-violet-700 @endif"><i class="fa-solid fa-gear fa-lg"></i>Setting</a>
  
</div>