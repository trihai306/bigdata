@extends('future::layouts.app')

@section('content')
    <div class="card">
        <div class="row g-0">
            @include('future::auth.profile.sidebar')
            @livewire('future::admin.notifications')
        </div>
    </div>
@endsection
