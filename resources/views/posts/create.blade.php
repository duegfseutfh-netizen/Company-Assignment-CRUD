@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Create New Post</h1>
        <a href="/posts" class="btn btn-secondary">← Back to Posts</a>
    </div>

    <div class="card">
        <form method="POST" action="/posts" novalidate>
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    class="@error('title') input-invalid @enderror"
                    placeholder="Enter post title"
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
                    value="{{ old('author') }}"
                    class="@error('author') input-invalid @enderror"
                    placeholder="Enter author name"
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
                    placeholder="Write post content..."
                    required
                >{{ old('content') }}</textarea>
                @error('content')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="table-actions">
                <button type="submit" class="btn">Save Post</button>
                <a href="/posts" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

