@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Users table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        User
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Activated/Disabled at
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $user->img ? asset('storage/'.$user->img) : asset("/imgs/no-image.png") }}" class="avatar avatar-sm me-3" alt="#">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $user->username }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                                </div>
                                            </div>

                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span
                                                class="badge badge-sm {{ is_null($user->deleted_at) ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">{{ is_null($user->deleted_at) ? 'Active' : 'Inactive' }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{ is_null($user->deleted_at) ? $user->created_at->format('d/m/Y') : $user->deleted_at->format('d/m/Y') }}</span>
                                        </td>
                                        <td class="align-middle d-flex justify-content-evenly">
                                            <a href="{{route('users.show', $user)}}"
                                               class="btn btn-secondary btn-sm mr-2"
                                               data-toggle="tooltip" data-original-title="Show user">
                                                Show
                                            </a>
                                            <a href="{{route('users.edit', $user)}}"
                                               class="btn btn-secondary btn-sm mr-2"
                                               data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                            @if(is_null($user->deleted_at))
                                                <form action="{{route('users.destroy', ['user' => $user])}}" method="POST">
                                                    @method('DElETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary btn-sm"
                                                            data-toggle="tooltip" data-original-title="Delete user">
                                                        Disable
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{route('users.recover', ['user' => $user])}}" method="POST">
                                                     @csrf
                                                <button type="submit" class="btn btn-secondary btn-sm"
                                                        data-toggle="tooltip" data-original-title="Delete user">
                                                    Activate
                                                </button>
                                                </form>
                                            @endif
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
