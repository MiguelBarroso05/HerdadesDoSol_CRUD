@extends('layouts.app')

@section('content')
    <div class="min-vh-90">
        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    @include('layouts.navbars.guest.navbar')
                </div>
                <div class="card card-profile shadow mt-10 ">
                    <div class="card-header text-center">
                        <h4 class="card-title">User Profile</h4>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username" class="form-control-label">Username</label>
                                        <input class="form-control" type="text" id="username"
                                               value="{{ auth()->user()->username }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email address</label>
                                        <input class="form-control" type="email" id="email"
                                               value="{{ auth()->user()->email }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first-name" class="form-control-label">First name</label>
                                        <input class="form-control" type="text" id="first-name"
                                               value="{{ auth()->user()->firstname }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last-name" class="form-control-label">Last name</label>
                                        <input class="form-control" type="text" id="last-name"
                                               value="{{ auth()->user()->lastname }}" readonly>
                                    </div>
                                </div>

                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Contact Information</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="address" class="form-control-label">Address</label>
                                            <input class="form-control" type="text" id="address"
                                                   value="123 Main St, Hometown"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city" class="form-control-label">City</label>
                                            <input class="form-control" type="text" id="city" value="Hometown" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="country" class="form-control-label">Country</label>
                                            <input class="form-control" type="text" id="country" value="Countryland"
                                                   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="postal-code" class="form-control-label">Postal code</label>
                                            <input class="form-control" type="text" id="postal-code" value="12345"
                                                   readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
