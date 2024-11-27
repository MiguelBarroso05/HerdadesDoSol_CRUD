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
                            New accommodations
                        </h5>
                    </div>
                </div>
                <div class="container-fluid py-4">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form method="POST" action="{{route('accommodations.store')}}">
                                @csrf
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                    </div>
                                @endif
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul>
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
                                            <p class="mb-0">New Accommodations</p>
                                            <div>
                                                <a href="{{ url()->previous()}}"
                                                   class="btn btn-secondary btn-sm ms-auto">Cancel</a>
                                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Create
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-uppercase text-sm">Accommodations Information</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Room Type</label>
                                                    <select class="form-control @error('name') is-invalid @enderror"
                                                            name="room_type_id" id="room-select">
                                                        @foreach($room_types as $room_type)
                                                            <option value="{{$room_type->id}}">
                                                                {{$room_type->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Size</label>
                                                    <select class="form-control @error('size') is-invalid @enderror"
                                                            name="size" id="room-select">
                                                        <option
                                                            value="1" {{ old('size') == '1' ? 'selected' : '' }}>
                                                            1
                                                        </option>
                                                        <option
                                                            value="2" {{ old('size') == '2' ? 'selected' : '' }}>
                                                            2
                                                        </option>
                                                        <option
                                                            value="3" {{ old('size') == '3' ? 'selected' : '' }}>
                                                            3
                                                        </option>
                                                        <option
                                                            value="4" {{ old('size') == '4' ? 'selected' : '' }}>
                                                            4
                                                        </option>
                                                        <option
                                                            value="5" {{ old('size') == '5' ? 'selected' : '' }}>
                                                            5
                                                        </option>
                                                        <option
                                                            value="6" {{ old('size') == '6' ? 'selected' : '' }}>
                                                            6
                                                        </option>
                                                    </select>
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Accommodations Description</label>
                                                    <textarea
                                                        class="form-control @error('description') is-invalid @enderror"
                                                        name="description">{{old('description')}}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @include('layouts.footers.footer')
                        </div>
@endsection
