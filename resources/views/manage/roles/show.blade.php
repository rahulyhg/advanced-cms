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
            <div class="card">
                <div class="card-header">Permissions that role have</div>
                <div class="card-body">
                    @foreach($role->permissions as $permission)
                    <ul>
                        <li>{{ $permission->display_name.' ('.$permission->description.')' }}</li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection