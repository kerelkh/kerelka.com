<div data-aos="fade-left" class="absolute top-0 left-0 right-0 py-3 px-12 flex justify-end items-center space-x-5 bg-[#1B203D]">
  <p class="text-gray-50">Hi, {{ Auth::user()->name }}</p>
  <div class="rounded-full overflow-hidden border-2 flex justify-center items-center border-blue-500">
    <img src="{{ asset('images/writer.jpg') }}" alt="author" class="h-10 w-10 object-cover">
  </div>
  <form action="{{ route('auth.logout') }}" method="POST">
    @csrf
    <button class="text-red-800 hover:text-red-400 transition-all"><i class="fa-solid fa-right-from-bracket fa-lg"></i></button>
  </form>
</div>