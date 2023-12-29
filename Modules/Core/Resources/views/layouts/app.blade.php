<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Buttons - Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>
<body class="position-relative">
@include('core::components.page-loader')
<script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
<div class="page">

    @include('core::app.header')
    <div class="page-wrapper">
        @include('core::app.page_header')

        <div class="page-body">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>
        @include('core::app.footer')
    </div>
</div>

@include('core::app.modal.activities')

<!-- Libs JS -->
<!-- Tabler Core -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/app.js')
<script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
<script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
<script src="{{ asset('dist/js/custom.js') }}" defer></script>
@include('core::components.scripts.swal')
@include('core::components.scripts.toast')

@yield('script')
</body>
</html>
