@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>Roles</h3>
        </div>
        <div class="col-md-4">
            <a href="{{ route('manage.roles.create') }}" class="btn btn-primary">Create New Role</a>
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
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Description</th>
                    <th colspan="4">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{$role->id}}</td>
                    <td>{{$role->display_name}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->description}}</td>
                    <td><a href="{{ route('manage.roles.show', $role)}}" class="btn btn-success">Show</a></td>
                    <td><a href="{{ route('manage.roles.edit', $role)}}" class="btn btn-warning">Edit</a></td>
                    <td><a href="{{ route('manage.roles.assign_permissions_form', $role)}}" class="btn btn-warning">Assign Permissions</a></td>
                    <td>
                        <form action="{{ route('manage.roles.destroy', $role)}}" method="post">
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
                    {!!$roles->links(); !!}
                </div>
            </tbody>
        </table>
    </div>
</div>
@endsection