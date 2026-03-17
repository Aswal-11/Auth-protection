@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Role Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $role->name }}</h5>
            <p class="card-text">{{ $role->description }}</p>
            <p class="card-text"><strong>Permissions:</strong> {{ $role->permissions->pluck('name')->join(', ') ?: 'None' }}</p>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection