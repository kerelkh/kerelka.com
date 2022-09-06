<div id="sidenav" class="fixed top-0 overflow-hidden left-0 bottom-0 w-0 transition-all duration-300 ease-in-out z-50 border-r border-gray-300 bg-white shadow-xl flex flex-col justify-between items-stretch">
  <button onclick="toggleMenu()" class="absolute top-8 right-8 text-gray-600 hover:text-gray-800"><i class="fa-solid fa-x"></i></button>
  <div class="px-6">
    <div class="w-full mt-6">
      <img src="{{ asset('icons/icon-black.png') }}" class="w-28" alt="brand">
    </div>
    <div class="mt-2 flex flex-col items-stretch divide-y-2">
      <a href="/" class="py-2 flex items-center gap-2 first-letter:uppercase text-gray-600 text-sm md:text-base hover:text-gray-800"><i class="fa-solid fa-house-user"></i> Home</a>
      <a href="/blogs" class="py-2 flex items-center gap-2 first-letter:uppercase text-gray-600 text-sm md:text-base hover:text-gray-800"><i class="fa-solid fa-blog"></i> Blogs</a>
      <a href="/aboutme" class="py-2 flex items-center gap-2 first-letter:uppercase text-gray-600 text-sm md:text-base hover:text-gray-800"><i class="fa-solid fa-address-card"></i> About me</a>
      <a href="/projects" class="py-2 flex items-center gap-2 first-letter:uppercase text-gray-600 text-sm md:text-base hover:text-gray-800"><i class="fa-solid fa-diagram-project"></i> Projects</a>
      <a href="/designs" class="py-2 flex items-center gap-2 first-letter:uppercase text-gray-600 text-sm md:text-base hover:text-gray-800"><i class="fa-solid fa-compass-drafting"></i> Design</a>
    </div>
  </div>
  <div class="w-full px-6 py-2 space-y-2">
    <h2 class="text-sm text-gray-500 pb-2 border-b border-gray-300">Contact</h2>
    <p class="text-gray-600 text-xs">+62 812 5063 1693</p>
    <p class="text-gray-600 text-xs">kerelkaa@gmail.com</p>
  </div>
</div>
