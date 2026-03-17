@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Role</h1>

    <form action="{{ route('roles.update',$role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ $role->name }}"
                required>

        </div>

        <div class="mb-3">
            <label>Description</label>

            <textarea
                name="description"
                class="form-control">{{ $role->description }}</textarea>

        </div>

        <div class="mb-3">
            <label>Select Tables</label>

            <select
                name="table_names[]"
                class="form-control"
                multiple
                size="6">

                @foreach($tableNames as $table)

                <option
                    value="{{ $table }}"
                    {{ in_array($table,$selectedTables ?? []) ? 'selected' : '' }}>

                    {{ $table }}

                </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">
            <label>Permissions</label>

            <div class="row">

                @foreach($permissions as $permission)

                <div class="col-md-3">

                    <div class="form-check">

                        <input
                            type="checkbox"
                            name="permissions[]"
                            value="{{ $permission->id }}"
                            class="form-check-input"
                            id="perm{{ $permission->id }}"
                            {{ in_array($permission->id,$rolePermissions ?? []) ? 'checked' : '' }}>

                        <label
                            class="form-check-label"
                            for="perm{{ $permission->id }}">

                            {{ $permission->name }}

                        </label>

                    </div>

                </div>

                @endforeach

            </div>

        </div>

        <button type="submit" class="btn btn-primary">
            Update Role
        </button>

        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            Back
        </a>

    </form>

</div>
@endsection