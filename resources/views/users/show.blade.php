@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ $user->img ? asset('storage/'.$user->img) : asset("/imgs/no-image.png") }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{$user->firstname .' '. $user->lastname}}
                        </h5>
                    </div>
                </div>
                <div class="container-fluid py-4">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header pb-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="mb-0">Show User</p>
                                        <div>
                                            <a href="{{route('users.index')}}"
                                               class="btn btn-secondary btn-sm ms-auto">Cancel</a>
                                            <a type="submit" class="btn btn-primary btn-sm ms-auto" href="{{route('users.edit', $user)}}">Edit
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="text-uppercase text-sm">User Information</p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Username</h5>
                                            <p>{{$user->username}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Email</h5>
                                            <p>{{$user->email}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>First Name</h5>
                                            <p>{{$user->firstname}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Last Name</h5>
                                            <p>{{$user->lastname}}</p>
                                        </div>
                                    </div>
                                    <hr class="horizontal dark">
                                    <p class="text-uppercase text-sm">Contact Information</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5>Address</h5>
                                            <p>{{$user->address}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>City</h5>
                                            <p>{{$user->city}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Country</h5>
                                            <p>{{$user->country}}</p>
                                        </div>
                                        <div class="col-md-4">
                                            <h5>Postal Code</h5>
                                            <p>{{$user->postal}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('layouts.footers.footer')
                        </div>
@endsection
