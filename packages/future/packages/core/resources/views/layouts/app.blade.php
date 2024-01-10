<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Tabler - Premium and Open Source dashboard template with responsive and high quality UI.</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}"   rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}"   rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}"   rel="stylesheet"/>
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}"   rel="stylesheet"/>
    <link href="{{ asset('dist/libs/star-rating.js/dist/star-rating.min.css') }}"   rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('dist/css/demo.min.css') }}"   rel="stylesheet"/>
    <link href="{{ asset('dist/css/app.css') }}"  rel="stylesheet"/>
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
    @livewireStyles

</head>
<body class="position-relative">

<script src="{{ asset('dist/js/demo-theme.min.js') }}" ></script>
<div class="page">
    @include('future::app.header')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>
        @include('future::app.footer')
        @livewire('future::livewire.admin.notifications')

    </div>
</div>
<!-- Libs JS -->
<!-- Tabler Core -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" ></script>
@vite('resources/js/app.js')
<script src="{{ asset('dist/js/tabler.min.js') }}" ></script>
<script src="{{ asset('dist/js/demo.min.js') }}" ></script>
<script src="{{ asset('dist/js/custom.js') }}" ></script>
<script src="{{ asset('dist/libs/nouislider/dist/nouislider.min.js') }}" ></script>
<script src="{{ asset('dist/libs/litepicker/dist/litepicker.js') }}" ></script>
<script src="{{ asset('dist/libs/tom-select/dist/js/tom-select.base.min.js') }}" ></script>
<script src="{{ asset('dist/libs/tinymce/tinymce.min.js') }}" ></script>
<script src="{{ asset('dist/libs/star-rating.js/dist/star-rating.min.js') }}" ></script>
@include('future::components.scripts.swal')
@include('future::components.scripts.toast')
@include('future::components.page-loader')
<script >

    window.onload = function() {

        var loadingDiv = document.getElementById('page-loading');
        if (loadingDiv) {
            console.log('Runs only on page one')
            loadingDiv.style.display = 'none';
        }
    };
</script>
@livewireScripts
@yield('script')
</body>
</html>
