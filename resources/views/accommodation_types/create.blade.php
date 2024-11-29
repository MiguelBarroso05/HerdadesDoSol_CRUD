@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'accommodation Type'])
    <div class="container-fluid py-4 mt-8">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('accommodation_types.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- accommodation Type Card -->
                    <div class="card-body p-3">
                        <div class="row gx-4">
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        New Accommodation Type
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- accommodation Type Information Card -->
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0">Create Accommodation Type</p>
                                <!-- Action Buttons -->
                                <div>
                                    <!-- Create -->
                                    <button type="submit" class="btn btn-primary btn-sm ms-auto bg-gradient-success">
                                        Create
                                    </button>
                                    <!-- Cancel -->
                                    <a href="{{ route('accommodation_types.index') }}"
                                       class="btn btn-secondary btn-sm ms-auto bg-gradient-danger">Cancel</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <!-- accommodation Type Information Section -->
                            <p class="text-uppercase text-sm">Information</p>
                            <div class="row">
                                <!-- accommodation Type Image Upload -->
                                <div class="col-md-6">
                                    <label class="form-control-label">Image</label>
                                    <input type="file" class="form-control" name="img" id="inputGroupFile02"
                                           accept="image/*">
                                </div>

                                <!-- accommodation Type Name Input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                               name="name" value="{{ old('name') }}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
