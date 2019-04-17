@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    Welcome to role permission management dashboard
                    <div class="list-group">
                        @permission('read-users')
                        <a href="{{ route('manage.users.index') }}" class="list-group-item list-group-item-action">
                            User Management
                        </a>
                        @endpermission
                        @permission('read-roles')
                        <a href="{{ route('manage.roles.index') }}" class="list-group-item list-group-item-action">Role Management</a>
                        @endpermission
                        @permission('read-permissions')
                        <a href="{{ route('manage.permissions.index') }}" class="list-group-item list-group-item-action">Permission Management</a>
                        @endpermission
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection