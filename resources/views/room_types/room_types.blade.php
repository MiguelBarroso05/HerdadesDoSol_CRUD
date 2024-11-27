@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>Room Types table</h6>
                        <a href="{{route('room_types.create')}}" class="btn btn-primary btn-sm mr-2"
                           data-toggle="tooltip" data-original-title="Show user">
                            Create new room type
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Room Type</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Last Update</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($room_types as $room_type)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/team-2.jpg" class="avatar avatar-sm me-3" alt="#">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $room_type->name }}</h6>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$room_type->updated_at}}</span>
                                        </td>
                                        <td class="align-middle d-flex justify-content-evenly">
                                            <a href="{{route('room_types.edit', $room_type)}}" class="btn btn-secondary btn-sm mr-2"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                            <form action="{{route('room_types.destroy', ['room_type' => $room_type])}}" method="POST">
                                                @method('DElETE')
                                                @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm"
                                                        data-toggle="tooltip" data-original-title="Delete room type">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



