@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h3>Permissions</h3>
        </div>
        <div class="col-md-4">
            <a href="{{ route('manage.permissions.create') }}" class="btn btn-primary">Create New Permission</a>
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
                    <th colspan="3">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->display_name}}</td>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->description}}</td>
                    <td><a href="{{ route('manage.permissions.show', $permission)}}" class="btn btn-success">Show</a></td>
                    <td><a href="{{ route('manage.permissions.edit', $permission)}}" class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{ route('manage.permissions.destroy', $permission)}}" method="post">
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
                    {!!$permissions->links(); !!}
                </div>
            </tbody>
        </table>
    </div>
</div>
@endsection