<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://kit.fontawesome.com/96e593092d.css" crossorigin="anonymous">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
    <body>
        @include('includes.sidebar')
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
        <script src="https://kit.fontawesome.com/96e593092d.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
