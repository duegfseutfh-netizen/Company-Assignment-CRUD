<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostCrudTest extends TestCase
{
    use DatabaseMigrations;

    public function test_posts_index_shows_empty_state_when_no_posts_exist(): void
    {
        $this->get('/posts')
            ->assertOk()
            ->assertSee('No posts found.');
    }

    public function test_user_can_create_view_edit_and_delete_a_post(): void
    {
        $this->get('/posts/create')->assertOk();

        $this->post('/posts', [
            'title' => 'First Training Post',
            'author' => 'Sara Ali',
            'content' => 'Learning Laravel CRUD inside PMT.',
        ])->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', [
            'title' => 'First Training Post',
            'author' => 'Sara Ali',
            'content' => 'Learning Laravel CRUD inside PMT.',
        ]);

        $post = Post::firstOrFail();

        $this->get('/posts')
            ->assertOk()
            ->assertSee('First Training Post')
            ->assertSee('Sara Ali');

        $this->get("/posts/{$post->id}")
            ->assertOk()
            ->assertSee('First Training Post')
            ->assertSee('Learning Laravel CRUD inside PMT.');

        $this->get("/posts/{$post->id}/edit")
            ->assertOk()
            ->assertSee('First Training Post');

        $this->put("/posts/{$post->id}", [
            'title' => 'Updated Training Post',
            'author' => 'Omar Hassan',
            'content' => 'Updated post content in SQLite.',
        ])->assertRedirect('/posts');

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Training Post',
            'author' => 'Omar Hassan',
            'content' => 'Updated post content in SQLite.',
        ]);

        $this->delete("/posts/{$post->id}")
            ->assertRedirect('/posts');

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_validation_rejects_empty_post_submission(): void
    {
        $this->from('/posts/create')
            ->post('/posts', [
                'title' => '',
                'author' => '',
                'content' => '',
            ])
            ->assertRedirect('/posts/create')
            ->assertSessionHasErrors(['title', 'author', 'content']);

        $this->assertDatabaseCount('posts', 0);
    }

    public function test_posts_search_filters_results_and_escapes_html(): void
    {
        Post::create([
            'title' => '<script>alert(1)</script>',
            'author' => 'Lina',
            'content' => 'Security check post.',
        ]);
        Post::create([
            'title' => 'Database Migrations',
            'author' => 'Nabil',
            'content' => 'Eloquent schema guide.',
        ]);

        $this->get('/posts?search=Migrations')
            ->assertOk()
            ->assertSee('Database Migrations')
            ->assertDontSee('Lina');

        $this->get('/posts')
            ->assertOk()
            ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
            ->assertDontSee('<script>alert(1)</script>', false);
    }

    public function test_existing_tasks_page_still_works(): void
    {
        $this->get('/tasks')->assertOk();
    }
}

