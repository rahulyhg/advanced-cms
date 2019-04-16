@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>Users</h3>
        </div>
        <div class="col-md-4">
            <a href="{{ route('manage.users.create') }}" class="btn btn-primary">Create New User</a>
        </div>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div><br />
    @elseif (\Session::has('fail'))
    <div class="alert alert-danger">
        <p>{{ \Session::get('fail') }}</p>
    </div><br />
    @endif
    <div class="box table-responsive-xl">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th colspan="3">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>                    
                    <td><a href="{{ route('manage.users.show', $user)}}" class="btn btn-success">Show</a></td>
                    <td><a href="{{ route('manage.users.edit', $user)}}" class="btn btn-warning">Edit</a></td>
                    <td><a href="{{ route('manage.users.assign_roles_form', $user)}}" class="btn btn-warning">Assign Roles</a></td>
                    <td>
                        <form action="{{ route('manage.users.destroy', $user)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                            {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <div class="text-center">
                    {!!$users->links(); !!}
                </div>
            </tbody>
        </table>
    </div>
</div>
@endsection