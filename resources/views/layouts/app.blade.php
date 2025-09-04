<html>
    <head>
        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body>
        <header>
            <h1>Laravel</h1>
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            <p>Laravel</p>
        </footer>
    </body>
</html>
