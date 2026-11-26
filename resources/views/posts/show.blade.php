@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>{{ $post->title }}</h1>
        <div class="table-actions">
            <a href="/posts" class="btn btn-secondary">← Back to Posts</a>
            <a href="/posts/{{ $post->id }}/edit" class="btn">Edit Post</a>
            <button
                type="button"
                class="btn btn-danger js-open-delete-modal"
                data-action="/posts/{{ $post->id }}"
                data-title="{{ $post->title }}"
            >
                Delete
            </button>
        </div>
    </div>

    <div class="card">
        <p><strong>Author:</strong> {{ $post->author }}</p>
        <p><strong>Created At:</strong> {{ $post->created_at?->format('Y-m-d H:i') }}</p>
        <p><strong>Last Updated:</strong> {{ $post->updated_at?->format('Y-m-d H:i') }}</p>
        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 1rem 0;">
        <div style="white-space: pre-wrap; line-height: 1.6;">{{ $post->content }}</div>
    </div>

    @include('posts._delete_modal')
@endsection

