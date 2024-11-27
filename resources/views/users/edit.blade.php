@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="/img/team-1.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
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
                            <form action="{{route('users.update', $user->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="text-white">
                                            @foreach($errors->all() as $error)
                                                <li><strong>Error!</strong> {{ $error }}</li>
                                            @endforeach
                                        </ul>

                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0">Edit User</p>
                                            <div>
                                                <a href="{{ url()->previous()}}"
                                                   class="btn btn-secondary btn-sm ms-auto">Cancel</a>
                                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-uppercase text-sm">User Information</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Username</label>
                                                    <input class="form-control @error('username') is-invalid @enderror"
                                                           type="text" name="username"
                                                           value="{{old('username', $user->username)}}">
                                                    @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Email
                                                        address</label>
                                                    <input class="form-control @error('email') is-invalid @enderror"
                                                           type="email" name="email"
                                                           value="{{old('email', $user->email)}}">
                                                    @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">First
                                                        name</label>
                                                    <input class="form-control @error('firstname') is-invalid @enderror"
                                                           name="firstname" type="text"
                                                           value="{{old('firstname', $user->firstname)}}">
                                                    @error('firstname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Last
                                                        name</label>
                                                    <input class="form-control @error('lastname') is-invalid @enderror"
                                                           name="lastname" type="text"
                                                           value="{{old('lastname', $user->lastname)}}">
                                                    @error('lastname')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="horizontal dark">
                                        <p class="text-uppercase text-sm">Contact Information</p>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Address</label>
                                                    <input class="form-control" name="address" type="text"
                                                           value="{{old('address', $user->address)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">City</label>
                                                    <input class="form-control" type="text" name="city"
                                                           value="{{old('city', $user->city)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Country</label>
                                                    <input class="form-control" type="text" name="country"
                                                           value="{{old('country', $user->country)}}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Postal
                                                        code</label>
                                                    <input class="form-control" type="text" name="postal"
                                                           value="{{old('postal', $user->postal)}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                            @include('layouts.footers.footer')
@endsection
