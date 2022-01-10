<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">

  <title>Coronatime</title>

  <link href="{{ asset('css/app1.css') }}"
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

  <link rel="apple-touch-icon"
        sizes="180x180"
        href="{{ asset('images/apple-touch-icon.png') }}">
  <link rel="icon"
        type="image/png"
        sizes="32x32"
        href="{{ asset('images/favicon-32x32.png') }}">
  <link rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{ asset('images/favicon-16x16.png') }}">
  <link rel="manifest"
        href="{{ asset('images/site.webmanifest') }}">

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
         class="absolute flex items-center p-3 font-semibold text-white bg-green-400 rounded-md bottom-4 right-4"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show">
      <x-svgs.success />
      <p class="ml-2 text-xs">
        {{ __(session('success')) }}
      </p>
    </div>
  @endif


  @if (Route::is('login') || Route::is('register'))
    @if (session()->has('error'))
      <div x-data="{show: true, count: 0}"
           class="absolute flex items-center p-3 font-semibold text-white bg-red-400 rounded-md bottom-4 left-4"
           x-init="setTimeout(() => show = false, 4000)"
           x-show="show">
        <x-svgs.ban />
        <p class="ml-2 text-xs">
          {{ __(session('error')) }}
        </p>
      </div>
    @endif
  @else
    @if (session()->has('error'))
      <div x-data="{show: true, count: 0}"
           class="absolute flex items-center p-3 font-semibold text-white bg-red-400 rounded-md bottom-4 right-4"
           x-init="setTimeout(() => show = false, 4000)"
           x-show="show">
        <x-svgs.ban />
        <p class="ml-2 text-xs">
          {{ __(session('error')) }}
        </p>
      </div>
    @endif
  @endif



  @livewireScripts
</body>

</html>
