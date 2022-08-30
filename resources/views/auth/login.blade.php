<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login - KerelKA</title>
  <link rel="shortcut icon" href="{{ asset('icons/Icon.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  <div class="min-h-screen overflow-hidden flex justify-center items-center relative">
    <div class="w-full md:w-96 h-96 flex flex-col justify-center items-center rounded-2xl overflow-hidden relative">
      @if(session('error'))
      <div id="notice" class="text-red-900 bg-red-200 py-3 px-6 rounded mb-5 text-sm flex gap-4 justify-between items-center">* Given credential is not correct. <button onclick="closeNotice()" type="button" class="scale-90 hover:scale-100 hover:text-white hover:bg-red-900 rounded-lg p-1">X</button></div>
      @endif
      @if(session('message'))
      <div id="notice" class="text-green-900 bg-green-200 py-3 px-6 rounded mb-5 text-sm flex gap-4 justify-between items-center">* {{ session('message') }} <button onclick="closeNotice()" type="button" class="scale-90 hover:scale-100 hover:text-white hover:bg-red-900 rounded-lg p-1">X</button></div>
      @endif
      <form action="" method="POST">
        @csrf
        {{-- @if(session('error')) --}}
        {{-- @endif --}}
        <div class="flex flex-col space-y-3 mb-4">
          <input type="text" name="username" id="username" placeholder="username" onchange="removeUsernameError()" class="@error('username') border border-red-500 @enderror p-3 transition-all ease-in-out bg-black  text-green-500 scale-90 focus:scale-100 placeholder:italic placeholder:text-gray-600 rounded outline-none " autofocus autocomplete="off">
          <input type="password" name="password" id="password" placeholder="password" onchange="removePasswordError()" class="@error('password') border border-red-500 @enderror p-3 transition-all ease-in-out bg-black  text-green-500 scale-90 focus:scale-100 placeholder:italic placeholder:text-gray-600 rounded outline-none " autocomplete="off">
          <div class="text-green-500 flex justify-end items-center gap-3">
            <label for="remember" class="text-sm">Remember me ? </label>
            <input type="checkbox" name="remember" id="remember" class="scale-90 checked:bg-black  checked:text-green-500 outline-none">
          </div>
        </div>
        <button type="submit" class="bg-black text-green-500 p-3 rounded text-medium text-center w-full scale-90 hover:scale-100 outline-none transition-all ease-in-out">Login</button>
      </form>
    </div>
    <div class="fixed top-10 left-0 bg-black hover:bg-green-500/20 rounded-lg">
      <a href="/" class="p-5 pl-5 hover:pl-10 transition-all ease-in-out font-bold text-green-500 flex gap-4"><img src="https://img.icons8.com/material-rounded/24/26e07f/home.png"/> Home</a>
    </div>
    <img src="{{ asset('images/login.jpg') }}" alt="" class="absolute -z-50 w-full h-full object-cover">
  </div>

  <script>
    //notice script
    const noticeEl = document.getElementById('notice');

    function closeNotice() {
      noticeEl.classList.add('hidden');
    }

    //error script
    const usernameEl = document.getElementById('username');
    const passwordEl = document.getElementById('password');

    function removeUsernameError() {
      usernameEl.classList.remove('border');
      usernameEl.classList.remove('border-red-500');
    }

    function removePasswordError() {
      passwordEl.classList.remove('border');
      passwordEl.classList.remove('border-red-500');
    }
  </script>
</body>
</html>
