@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Create Role</h1>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Name</label>

            <input
                type="text"
                name="name"
                class="form-control"
                required>

        </div>

        <div class="mb-3">
            <label>Description</label>

            <textarea
                name="description"
                class="form-control"></textarea>

        </div>

        <div class="mb-3">
            <label>Select Tables</label>

            <select
                name="table_names[]"
                class="form-control"
                multiple
                size="6">

                @foreach($tableNames as $table)

                <option value="{{ $table }}">
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
                            id="perm{{ $permission->id }}">

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
            Create Role
        </button>

        <a href="{{ route('roles.index') }}" class="btn btn-secondary">
            Back
        </a>

    </form>

</div>
@endsection