@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Edit Post</h1>
        <a href="/posts" class="btn btn-secondary">← Back to Posts</a>
    </div>

    <div class="card">
        <form method="POST" action="/posts/{{ $post->id }}" novalidate>
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title', $post->title) }}"
                    class="@error('title') input-invalid @enderror"
                    required
                >
                @error('title')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input
                    id="author"
                    type="text"
                    name="author"
                    value="{{ old('author', $post->author) }}"
                    class="@error('author') input-invalid @enderror"
                    required
                >
                @error('author')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea
                    id="content"
                    name="content"
                    rows="6"
                    class="@error('content') input-invalid @enderror"
                    required
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="table-actions">
                <button type="submit" class="btn">Update Post</button>
                <a href="/posts/{{ $post->id }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

