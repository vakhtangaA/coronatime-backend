<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <link href="{{ asset('css/app.css') }}"
        rel="stylesheet">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        rel="stylesheet">

  <link rel="preconnect"
        href="https://fonts.googleapis.com">
  <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

  <script src="{{ asset('js/app.js') }}"
          defer></script>
  @livewireStyles
</head>

<body>
  <script>
    0
  </script>

  {{ $slot }}

  @if (session()->has('success'))
    <div x-data="{show: true, count: 0}"
         class="flex items-center absolute bottom-4 right-4  bg-green-400 p-3 rounded-md text-white font-semibold"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show">
      <x-svgs.success />
      <p class="ml-2 text-xs">
        {{ session('success') }}
      </p>
    </div>
  @endif

  @if (session()->has('error'))
    <div x-data="{show: true, count: 0}"
         class="flex items-center absolute bottom-4 right-4  bg-red-400 p-3 rounded-md text-white font-semibold"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show">
      <x-svgs.success />
      <p class="ml-2 text-xs">
        {{ session('error') }}
      </p>
    </div>
  @endif



  @livewireScripts
</body>

</html>
