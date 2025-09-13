<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.landing-head')
</head>

<body class="index-page">

    <header id="header" class="header sticky-top">
        @include('layouts.landing-navbar')
    </header>

    <main class="main">
        @yield('content')
    </main>

    @include('layouts.landing-footer')

</body>

</html>
