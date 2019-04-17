@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Permission') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('manage.permissions.store') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="permissionType" id="basic" value="basic" checked="true">
                                <label class="form-check-label" for="basic">Basic Permission</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="permissionType" id="crud" value="crud">
                                <label class="form-check-label" for="crud">CRUD Permission</label>
                            </div>
                        </div>
                        <div id="basic-form">
                            <div class="form-group row">
                                <label for="display_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="display_name" type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="{{ old('display_name') }}" required autofocus>
                                    @if ($errors->has('display_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Slug') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') }}" required autofocus>
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="crud-form" hidden>
                            <div class="form-group row">
                                <label for="resource" class="col-md-4 col-form-label text-md-right">{{ __('Resource name') }}</label>
                                <div class="col-md-6">
                                    <input id="resource" type="text" class="form-control{{ $errors->has('resource') ? ' is-invalid' : '' }}" name="resource" value="{{ old('resource') }}" placeholder="Please enter resource in plural (example:posts)" autofocus>
                                    @if ($errors->has('resource'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('resource') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="create" name="reourcePermissions[]" value="create">
                                <label class="form-check-label" for="create">
                                    Create
                                </label>
                            </div>                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox"  id="read" name="reourcePermissions[]" value="read">
                                <label class="form-check-label" for="read">
                                    read
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="update" name="reourcePermissions[]" value="update">
                                <label class="form-check-label" for="update">
                                    update
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="delete" name="reourcePermissions[]" value="delete">
                                <label class="form-check-label" for="delete">
                                    delete
                                </label>
                            </div>                            
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                {{ __('Save') }}
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
    $('[name="permissionType"]').on('change', function(){
        if ($(this).val()=='basic') {         
             $('#basic-form').show();             
             $("#crud-form").attr("hidden", true);
             $("#name").attr("required", true);
             $("#display_name").attr("required", true);
             $("#description").attr("required", true);             
             $("#resource").removeAttr("required");                 
        } else  {             
             $('#crud-form').removeAttr("hidden");
             $('#basic-form').hide();             
             $("#name").removeAttr("required");
             $("#display_name").removeAttr("required");
             $("#description").removeAttr("required");             
             $("#resource").attr("required", true);                 
        }
    });
  });
</script>
@endsection