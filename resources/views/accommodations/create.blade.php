@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Accommodation'])
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{route('accommodations.store')}}">
                    @csrf
                    <!-- Accommodation Card -->
                    <div class="card-body p-3">
                        <div class="row gx-4">
                            <!-- Accommodation Name Section -->
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        New Accommodation
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Error Messages -->
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

                    <!-- Accommodation Information Card -->
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Create Accommodation</p>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto bg-gradient-success">
                                        Create
                                    </button>
                                    <a href="{{ route('accommodations.index')}}"
                                       class="btn btn-secondary btn-sm ms-auto bg-gradient-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Accommodation Information Section -->
                            <p class="text-uppercase text-sm">Information</p>
                            <div class="row">

                                <!-- Accommodation Type Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Type</label>
                                        <select
                                            class="form-control @error('accommodation_type_id') is-invalid @enderror"
                                            name="accommodation_type_id" id="room-select">
                                            @foreach($accommodation_types as $accommodation_type)
                                                <option value="{{$accommodation_type->id}}">
                                                    {{$accommodation_type->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('accommodation_type_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Accommodation Size Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Size</label>
                                        <select class="form-control @error('size') is-invalid @enderror"
                                                name="size" id="room-select">
                                            @foreach ([1, 2, 3, 4, 5, 6] as $size)
                                                <option
                                                    value="{{ $size }}"
                                                    {{ old('size') == $size ? 'selected' : '' }}>
                                                    {{ $size }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('size')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Accommodation Description Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input"
                                               class="form-control-label">Description</label>
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
            </div>
@endsection
