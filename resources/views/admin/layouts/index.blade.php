<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin | {{ $page }}</title>
  <link rel="shortcut icon" href="{{ asset('icons/Icon.png') }}" type="image/png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
  <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <script src={{ asset('js/jquery-3.6.0.min.js') }}></script>
  <script src="{{ asset('js/datatables.js') }}"></script>
  <script src="{{ asset('js/aos.js') }}"></script>
  <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>
  <div id="app" class="bg-[#1B203D] h-screen overflow-hidden font-sans flex">
    @include('admin.components.sidenav')
    <div class="relative w-full h-full ">
      @include('admin.components.nav')
      <div class="w-full h-full py-14 overflow-hidden">
        @yield('content')
      </div>
    </div>
  </div>


  <script>
    (function() {
      AOS.init();
    })();
  </script>
</body>
</html>