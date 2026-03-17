@extends('layouts.app')

@section('content')
<form method="POST" action="/login">
    @csrf

    <div class="mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
    </div>

    <div class="mb-3">
        <label class="form-label" for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>
@endsection