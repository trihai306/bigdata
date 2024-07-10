<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" value="{{ csrf_token() }}" content="{{ csrf_token() }}">
    <title>FUTURE</title>
    <!-- CSS files -->
    @futureStyles
    @yield('style')
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
    @vite([
        'packages/adminftr/core/resources/assets/sass/app.scss'
    ])

</head>
<body class="position-relative">
<script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
<div class="page" id="page">
    @include('future::app.header')
    <div class="page-wrapper {{ $_COOKIE['sidebarState'] === 'collapsed' ? 'state-collapsed' : '' }}"
         id="page-wrapper">
        <div class="page-body">
            <div class="container-fluid" id="content">
                @yield('content')
            </div>
            @include('future::loading')
        </div>
        @include('future::app.footer')

    </div>
    @include('future::app.sidebar')

</div>

<livewire:future::notifications/>
<!-- Libs JS -->
<!-- Tabler Core -->
@vite(['resources/js/app.js'])
@vite(['packages/adminftr/core/resources/assets/js/app.js'])
<script data-navigate-once src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script data-navigate-once src="https://cdn.jsdelivr.net/npm/lightgallery/lightgallery.min.js"></script>
<script data-navigate-once src="{{ asset('dist/js/tabler.min.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/js/demo.min.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/js/custom.js') }}"></script>
<script data-navigate-once src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script data-navigate-once src="{{ asset('dist/libs/nouislider/dist/nouislider.min.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/libs/litepicker/dist/litepicker.js') }}"></script>
<script data-navigate-once src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script data-navigate-once
        src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script data-navigate-once src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"
        integrity="sha512-6JR4bbn8rCKvrkdoTJd/VFyXAN4CE9XMtgykPWgKiHjou56YDJxWsi90hAeMTYxNwUnKSQu9JPc3SQUg+aGCHw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script data-navigate-once src="{{ asset('dist/libs/star-rating.js/dist/star-rating.min.js') }}"></script>
<script data-navigate-once src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}"></script>

<livewire:future::notifications/>
@include('notifications::swal')
@include('notifications::toast')
@include('notifications::alerts')
@include('notifications::modal')
@yield('script')
@livewireScripts
</body>
</html>
