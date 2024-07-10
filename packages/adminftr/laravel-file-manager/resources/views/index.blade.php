@extends('future::layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
@endsection
@section('content')
    <div id="fm" style="height: 600px;"></div>
@endsection
@section('script')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
@endsection
