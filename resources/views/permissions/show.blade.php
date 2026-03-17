@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Permission Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $permission->name }}</h5>
            <p class="card-text"><strong>Slug:</strong> {{ $permission->slug }}</p>
            <p class="card-text"><strong>Roles:</strong> {{ $permission->roles->pluck('name')->join(', ') ?: '—' }}</p>
            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection
