@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $role->display_name }}</div>
        <div class="card-body">
          <p>{{ $role->name }}</p>
          <p>{{ $role->description }}</p>
        </div>
      </div>
      <form method="POST" action="{{ route('manage.roles.assign_permissions', $role) }}">
        @csrf
        <div class="box table-responsive-xl">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Permission</th>
                <th>Name</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              @foreach($permissions as $permission)
              <tr>
                <td>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="{{ $permission->name }}" name="rolePermissions[]" value="{{ $permission->id }}" {{in_array($permission->id, $assignedPermissions)?'checked':''}}>
                  </div>
                </td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->description}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
            {{ __('Submit') }}
            </button>
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>
@endsection