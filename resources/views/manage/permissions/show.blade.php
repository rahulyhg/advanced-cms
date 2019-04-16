@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $permission->display_name }}</div>
                <div class="card-body">
                    <p>{{ $permission->name }}</p>
                    <p>{{ $permission->description }}</p>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection