@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ $user->name }}</div>
        <div class="card-body">
          <p>{{ $user->email }}</p>
        </div>
      </div>
      <form method="POST" action="{{ route('manage.users.assign_roles', $user) }}">
        @csrf
        <div class="box table-responsive-xl">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Role</th>
                <th>Name</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              @foreach($roles as $role)
              <tr>
                <td>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="{{ $role->name }}" name="userRoles[]" value="{{ $role->id }}" {{in_array($role->id, $assignedRoles)?'checked':''}}>
                  </div>
                </td>
                <td>{{$role->name}}</td>
                <td>{{$role->description}}</td>
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