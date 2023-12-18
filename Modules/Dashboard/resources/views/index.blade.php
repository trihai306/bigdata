@extends('core::layouts.app')

@section('content')
    <h1>Hello World</h1>

    <p>Module: {!! config('dashboard.name') !!}</p>
@endsection
