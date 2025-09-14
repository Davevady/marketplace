<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>@yield('title','Atlantis Lite - Bootstrap 4 Admin Dashboard')</title>
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
<link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon" />

<!-- Fonts and icons -->
<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {
            families: ["Lato:300,400,700,900"]
        },
        custom: {
            families: [
                "Flaticon",
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('assets/css/fonts.min.css') }}"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
    </script>

<!-- CSS Files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}" />

<style>
    .is-active-true {
        background-color: #9cff9c !important;
        /* cursor: not-allowed; */
    }
    .is-active-false {
        background-color: #ff9c9c ;
        /* cursor: not-allowed; */
    }
</style>
