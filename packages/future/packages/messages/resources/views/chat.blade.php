@extends('future::layouts.app')
@section('content')
<div class="card">
    <div class="row g-0">
        @livewire('future::livewire.messages.list-conversation')
        @livewire('future::livewire.messages.messages')
    </div>
</div>
@endsection
@section('script')

@endsection
