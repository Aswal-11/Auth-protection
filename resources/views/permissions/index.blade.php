@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Permissions</h1>
    @can('create', \App\Models\Permission::class)
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">Create New Permission</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->slug }}</td>
                <td>{{ $permission->roles->pluck('name')->join(', ') }}</td>
                <td>
                    <a href="{{ route('permissions.show', $permission->id) }}" class="btn btn-info">View</a>
                    @can('update', $permission)
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning">Edit</a>
                    @endcan
                    @can('delete', $permission)
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
