@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome to your dashboard!</p>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Roles</h5>
                    <p class="card-text">Manage user roles in the system.</p>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">View Roles</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Subusers</h5>
                    <p class="card-text">Manage subusers and their roles.</p>
                    <a href="{{ route('subusers.index') }}" class="btn btn-primary">View Subusers</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Posts</h5>
                    <p class="card-text">Create and manage your posts.</p>
                    <a href="{{ route('posts.index') }}" class="btn btn-primary">View Posts</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection