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
            <div class="card">
                <div class="card-header">Roles that user have</div>
                <div class="card-body">
                    @foreach($user->roles as $role)
                    <ul>
                        <li>{{ $role->display_name.' ('.$role->description.')' }}</li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection