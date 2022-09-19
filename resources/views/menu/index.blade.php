<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>kamorin's app</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/ress/dist/ress.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background-color: #f6f5f4;
        }

        .side {
            background-color: #ff838b;
            width: 100px;
            height: 300px;
            text-align: center;
        }

        .content {
            background-color: #b3d874;
            width: 250px;
            height: 300px;
            text-align: center;
            margin-left: 10px;
            /*サイドバーとメインコンテンツの間に隙間                    をあけた*/
        }

        article {
            display: flex;
            /*サイドバーとメインコンテンツを横並びにする                指定をした*/
        }
    </style>
</head>

<body>
    <header>
        <h1>kamorin's サイト-おためし-</h1>
    </header>
    <div id="app">
    </div>
    <footer>
        <h3>kamorin 2021</h3>
    </footer>
</body>

</html>