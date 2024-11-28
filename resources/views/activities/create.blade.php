@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])
    <div class="card shadow-lg mx-4 card-profile-bottom">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="col-auto">
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            New Activity
                        </h5>
                    </div>
                </div>
                <div class="container-fluid py-4">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form method="POST" action="{{route('activities.store')}}" enctype="multipart/form-data">
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
                                            <p class="mb-0">New Activity</p>
                                            <div>
                                                <a href="{{ url()->previous()}}"
                                                   class="btn btn-secondary btn-sm ms-auto">Cancel</a>
                                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Create
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-uppercase text-sm">Activity Information</p>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="example-text-input"
                                                       class="form-control-label">Activity Photo</label>
                                                <input type="file" class="form-control" name="img" id="inputGroupFile02"
                                                       accept="image/*">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Activity Type</label>
                                                    <select
                                                        class="form-control @error('activity_type_id') is-invalid @enderror"
                                                        name="activity_type_id" id="activity-select">
                                                        @foreach($activity_types as $activity_type)
                                                            <option value="{{$activity_type->id}}">
                                                                {{$activity_type->name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('activity_type_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Activity Name</label>
                                                    <input class="form-control @error('name') is-invalid @enderror"
                                                           type="text" name="name"
                                                           value="{{old('name')}}">
                                                    @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                           class="form-control-label">Activity Description</label>
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

