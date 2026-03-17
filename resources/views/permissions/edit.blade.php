@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Permission</h1>

    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $permission->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $permission->slug) }}" required>
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Permission</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
