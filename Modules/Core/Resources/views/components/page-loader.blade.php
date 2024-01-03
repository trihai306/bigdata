<div class="page page-center position-fixed w-100 h-100 bg-dark" id="page-loading" style="z-index: 10000">
    <div class="container container-slim py-4">
        <div class="text-center">
            <div class="mb-3">
                <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{asset('dist/img/flags/ae.svg')}}" height="36" alt=""></a>
            </div>
            <div class="text-muted mb-3">Preparing application</div>
            <div class="progress progress-sm">
                <div class="progress-bar progress-bar-indeterminate"></div>
            </div>
        </div>
    </div>
</div>
<script data-navigate-once>
    window.onload = function() {
        var loadingDiv = document.getElementById('page-loading');
        if (loadingDiv) {
            loadingDiv.style.display = 'none';
        }
    };
</script>
