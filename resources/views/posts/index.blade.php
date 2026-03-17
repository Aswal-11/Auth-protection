@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>

    @can('create', \App\Models\Post::class)
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                        <p class="text-muted">By: {{ $post->user->name }}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View</a>
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this post?')">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection