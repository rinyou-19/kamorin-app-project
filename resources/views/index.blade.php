<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>kamorin's app</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      .contents-height {
        height: calc(100vh - 112px)
      }
    </style>
</head>

<body>
  <header>
    <h1 class="flex items-center justify-center bg-cyan-300 text-5xl h-16 align-middle">kamorin's サイト</h1>
  </header>
  <div id="app" class="contents-height"></div>
  <footer>
    <h2 class="absolute inset-x-0 bottom-0 flex items-center justify-center bg-cyan-300 text-3xl h-12">kamorin 2022</h2>
  </footer>
</body>

</html>