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
        <div class="card">
          <div class="card-header">Roles that user have</div>
          <div class="card-body">
            @foreach($roles as $role)
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="{{ $role->name }}" name="userRoles[]" value="{{ $role->id }}" {{in_array($role->id, $assignedRoles)?'checked':''}}>
              <label class="form-check-label" for="{{ $role->name }}">
                {{ $role->display_name. ' '. $role->description }}
              </label>
            </div>
            @endforeach
          </div>
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