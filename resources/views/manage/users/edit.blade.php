@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Edit User Info') }}</div>
        @if (session('fail'))
        <div class="alert alert-danger" role="alert">
          {{ session('fail') }}
        </div>
        @endif
        <div class="card-body">
          <form method="POST" action="{{ route('manage.users.update', $user) }}">
            @csrf
            @method('PATCH')
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
              <div class="col-md-6">
                <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}">
                @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}">
                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="currentPassword" class="col-md-4 col-form-label text-md-right">{{ __('This User Password') }}</label>
              <div class="col-md-6">
                <input id="currentPassword" type="password" class="form-control{{ $errors->has('currentPassword') ? ' is-invalid' : '' }}" name="currentPassword" required>
                @if ($errors->has('currentPassword'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('currentPassword') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="change-password" checked="true">
                  <label class="form-check-label" for="change-password">
                    Change Password
                  </label>
                </div>
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
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#change-email').on('click', function(){
      if (this.checked) {
        $("#email").removeAttr("disabled");
      }else {
        $("#email").attr("disabled", true);
      }
    });
    $('#change-password').on('click', function(){
      if (this.checked) {
        $("#password").removeAttr("disabled");
        $("#password-confirm").removeAttr("disabled");
      }else {
        $("#password").attr("disabled", true);
        $("#password-confirm").attr("disabled", true);
      }
    });
  });
</script>
@endsection