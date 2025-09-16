<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.head')
    </head>
    <body>
        <div class="wrapper">
            <div class="main-header">
                @include('layouts.navbar')
            </div>
            @include('layouts.sidebar')
            <div class="main-panel">
                @yield('content')
                @include('layouts.footer')
                @include('layouts.script')
                @stack('scripts')
            </div>
        </div>
    </body>
</html>
