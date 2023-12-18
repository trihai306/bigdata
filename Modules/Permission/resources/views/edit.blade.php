@extends('core::layouts.app')
@section('content')
    <!--begin::Content-->
    <div  class="content flex-row-fluid">
        <!--begin::Card-->
        <livewire:permission::edit id="{{$id}}" />
        <!--end::Card-->
    </div>
    <!--end::Content-->
@endsection
@section('script')

@endsection
