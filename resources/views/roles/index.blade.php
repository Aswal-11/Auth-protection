@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Roles</h1>
    @can('create', \App\Models\Role::class)
        <a href="{{ route('roles.create') }}" class="btn btn-primary">Create New Role</a>
    @endcan
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>
                <td>{{ $role->permissions->pluck('name')->join(', ') }}</td>
                <td>
                    <a href="{{ route('roles.show', $role->id) }}" class="btn btn-info">View</a>
                    @can('update', $role)
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                    @endcan
                    @can('delete', $role)
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
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