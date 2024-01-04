@extends('future::layouts.auth')
@section('content')
<div class="container container-tight py-4">
    <div class="text-center mb-4">
        <a href="/" class="navbar-brand navbar-brand-autodark"><img src="{{asset('admin/assets/media/email/logo-1.svg')}}" height="36" alt=""></a>
    </div>
    <div class="card card-md">
        @livewire('future::livewire.auth.login')
    </div>

</div>
@endsection
