<div id="nav" class="flex justify-between items-center py-5 border-b border-gray-300 mb-5 sm:mb-10 mx-2 sm:mx-4 md:mx-12 lg:mx-24 xl:mx-48">
  <div id="sideButton" onclick="toggleMenu()">
    <button class="w-fit h-fit p-2 rounded-full text-transparent bg-clip-text bg-gradient-to-br from-blue-500 to-purple-500 text-xl hover:scale-110 transition ease-in-out"><i class="fa-solid fa-bars"></i></button>
  </div>
  <a href="/">
    <div id="logo" class="h-12">
      <img src="{{ asset('icons/icon-black.png') }}" alt="Logo" class="h-full object-cover">
    </div>
  </a>
  <div class="flex md:hidden"></div>
  <div class="hidden md:flex space-x-10 items-center text-gray-600">
    <a href="https://www.facebook.com/kerelka" class="animate-bounce hover:text-gray-900"><i class="fa-brands fa-facebook-f"></i></a>
    <a href="#" class="animate-bounce hover:text-gray-900"><i class="fa-brands fa-twitter"></i></a>
    <a href="https://www.instagram.com/kerelkh/" class="animate-bounce hover:text-gray-900"><i class="fa-brands fa-instagram-square"></i></a>
  </div>
</div>

<script>
  function toggleMenu() {
    let sideEl = document.getElementById('sidenav');
    sideEl.classList.toggle('w-0');
    sideEl.classList.toggle('w-60');
  }
</script>