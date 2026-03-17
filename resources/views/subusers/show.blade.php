@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Subuser Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $subuser->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $subuser->email }}</p>
            <p class="card-text"><strong>Role:</strong> {{ $subuser->role?->name ?? '—' }}</p>
            <a href="{{ route('subusers.index') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('subusers.edit', $subuser->id) }}" class="btn btn-warning">Edit</a>
        </div>
    </div>
</div>
@endsection