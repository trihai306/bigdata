@extends('future::layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <!-- User Image and Name -->
            <div class="d-flex align-items-center">
                <img src="{{asset('static/avatars/001f.jpg')}}" class="rounded-circle" alt="User" style="width: 60px; height: 60px;">
                <div class="ms-3">
                    <h5>Max Smith <span class="badge bg-primary">Developer</span></h5>
                    <p class="text-muted mb-0">SF, Bay Area</p>
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
            <!-- Progress Bar -->
            <label for="profileCompletion">Profile Completion</label>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
            </div>
        </div>
    </div>

@endsection
