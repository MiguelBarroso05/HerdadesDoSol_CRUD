@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="/img/team-1.jpg" alt="activity_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{$activity->name}}
                        </h5>
                    </div>
                </div>
                <div class="container-fluid py-4">
                    <div class="row justify-content-center">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="mb-0">Show Activity</p>
                                        <div>
                                            <a href="{{route('activities.index')}}"
                                               class="btn btn-secondary btn-sm ms-auto">Cancel</a>
                                            <a type="submit" class="btn btn-primary btn-sm ms-auto" href="{{route('activities.edit', $activity)}}">Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-uppercase text-sm">Activity Information</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Activity Name</h5>
                                                <p>{{$activity->name}}</p>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Description</h5>
                                                <p>{{$activity->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('layouts.footers.footer')
                        </div>
@endsection

