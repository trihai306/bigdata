@extends('future::layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- User Image and Name -->
            <div class="d-flex align-items-center">
                <img src="{{asset(auth()->user()->avatar ?? 'static/avatars/001f.jpg')}}" class="rounded-circle" alt="User" style="width: 60px; height: 60px;">
                <div class="ms-3">
                    <h4>{{auth()->user()->name}}
                        <span class="badge bg-primary">
                            {{auth()->user()->role->name ?? 'không có role'}}
                        </span></h4>
                    <p class="text-muted mb-0">{{
                        auth()->user()->email ?? 'không có email'
}}</p>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Stats -->
            <div class="d-flex justify-content-evenly text-center">
                <div>
                    <h6>Earnings</h6>
                    <p class="text-success">$4,500</p>
                </div>
                <div>
                    <h6>Projects</h6>
                    <p class="text-danger">80</p>
                </div>
                <div>
                    <h6>Success Rate</h6>
                    <p class="text-success">60%</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>

@endsection
