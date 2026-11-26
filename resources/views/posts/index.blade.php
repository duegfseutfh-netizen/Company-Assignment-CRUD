@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Posts</h1>
        <a href="/posts/create" class="btn">+ Create Post</a>
    </div>

    <div class="card">
        <form method="GET" action="/posts" class="filter-bar">
            <input type="text" name="search" placeholder="Search title, author, or content..." value="{{ request('search') }}" style="flex: 1; min-width: 220px;">
            <button type="submit" class="btn">Search</button>
            <a href="/posts" class="btn btn-secondary">Reset</a>
        </form>
    </div>

    <div class="card">
        @if ($posts->count() > 0)
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Content</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <a href="/posts/{{ $post->id }}" style="font-weight: 600; color: #1e293b; text-decoration: none;">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                <td>{{ $post->author }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($post->content, 80) }}</td>
                                <td>{{ $post->created_at?->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="/posts/{{ $post->id }}" class="btn btn-secondary btn-sm">View</a>
                                        <a href="/posts/{{ $post->id }}/edit" class="btn btn-secondary btn-sm">Edit</a>
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm js-open-delete-modal"
                                            data-action="/posts/{{ $post->id }}"
                                            data-title="{{ $post->title }}"
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 1rem;">
                @if ($posts->previousPageUrl())
                    <a href="{{ $posts->previousPageUrl() }}" class="btn btn-secondary btn-sm">Previous</a>
                @endif
                <span style="margin: 0 0.5rem;">Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</span>
                @if ($posts->nextPageUrl())
                    <a href="{{ $posts->nextPageUrl() }}" class="btn btn-secondary btn-sm">Next</a>
                @endif
            </div>
        @else
            <div class="empty-state">
                <p style="margin-top: 0;">No posts found.</p>
                <a href="/posts/create" class="btn">+ Create First Post</a>
            </div>
        @endif
    </div>

    @include('posts._delete_modal')
@endsection

