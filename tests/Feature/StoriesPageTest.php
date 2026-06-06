<?php

namespace Tests\Feature;

use App\Models\Story;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoriesPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public user can view stories listing page.
     */
    public function test_public_user_can_view_stories_listing_page(): void
    {
        $stories = Story::factory()->count(3)->create();

        $response = $this->get('/stories');

        $response->assertStatus(200);
        foreach ($stories as $story) {
            $response->assertSee($story->title);
        }
    }

    /**
     * Test public user can view a single story detail.
     */
    public function test_public_user_can_view_single_story_detail(): void
    {
        $story = Story::factory()->create();

        $response = $this->get("/stories/{$story->id}");

        $response->assertStatus(200);
        $response->assertSee($story->title);
        $response->assertSee(explode("\n", $story->content)[0]);
    }

    /**
     * Test guest user cannot access admin stories endpoints.
     */
    public function test_unauthenticated_user_cannot_access_admin_stories_endpoints(): void
    {
        $response = $this->get('/admin/stories');
        $response->assertRedirect('/login');

        $response = $this->get('/admin/stories/create');
        $response->assertRedirect('/login');

        $response = $this->post('/admin/stories', []);
        $response->assertRedirect('/login');

        $response = $this->get('/admin/stories/1/edit');
        $response->assertRedirect('/login');

        $response = $this->put('/admin/stories/1', []);
        $response->assertRedirect('/login');

        $response = $this->delete('/admin/stories/1');
        $response->assertRedirect('/login');
    }

    /**
     * Test non-admin user is forbidden from admin stories endpoints.
     */
    public function test_non_admin_user_cannot_access_admin_stories_endpoints(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $story = Story::factory()->create();

        $response = $this->actingAs($user)->get('/admin/stories');
        $response->assertStatus(403);

        $response = $this->actingAs($user)->post('/admin/stories', []);
        $response->assertStatus(403);

        $response = $this->actingAs($user)->put("/admin/stories/{$story->id}", []);
        $response->assertStatus(403);

        $response = $this->actingAs($user)->delete("/admin/stories/{$story->id}");
        $response->assertStatus(403);
    }

    /**
     * Test admin user can access the stories list.
     */
    public function test_admin_user_can_access_admin_stories_list(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $story = Story::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/stories');

        $response->assertStatus(200);
        $response->assertSee($story->title);
    }

    /**
     * Test admin user can view the create form.
     */
    public function test_admin_user_can_view_stories_create_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/stories/create');

        $response->assertStatus(200);
        $response->assertSee('Add Folklore Story');
    }

    /**
     * Test admin user can store a new story.
     */
    public function test_admin_user_can_store_new_story_with_image(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);
        $image = UploadedFile::fake()->image('story.jpg');

        $response = $this->actingAs($admin)->post('/admin/stories', [
            'title' => 'Story of Singhasari',
            'category' => 'Legend',
            'excerpt' => 'A short summary.',
            'content' => 'Full story content goes here.',
            'image' => $image,
        ]);

        $response->assertRedirect('/admin/stories');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('stories', [
            'title' => 'Story of Singhasari',
            'category' => 'Legend',
            'excerpt' => 'A short summary.',
            'content' => 'Full story content goes here.',
        ]);

        // Verify stored file
        $story = Story::first();
        $this->assertNotNull($story->image);

        $relativePath = str_replace(asset('storage/'), '', $story->image);
        Storage::disk('public')->assertExists($relativePath);
    }

    /**
     * Test admin user can view the edit form.
     */
    public function test_admin_user_can_view_stories_edit_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $story = Story::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/stories/{$story->id}/edit");

        $response->assertStatus(200);
        $response->assertSee($story->title);
        $response->assertSee('Edit Folklore Story');
    }

    /**
     * Test admin user can update a story.
     */
    public function test_admin_user_can_update_story(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $story = Story::factory()->create([
            'title' => 'Old Title',
            'category' => 'Legend',
            'excerpt' => 'Old excerpt',
            'content' => 'Old content',
        ]);

        $response = $this->actingAs($admin)->put("/admin/stories/{$story->id}", [
            'title' => 'New Title',
            'category' => 'History',
            'excerpt' => 'New excerpt',
            'content' => 'New content',
        ]);

        $response->assertRedirect('/admin/stories');
        $this->assertDatabaseHas('stories', [
            'id' => $story->id,
            'title' => 'New Title',
            'category' => 'History',
            'excerpt' => 'New excerpt',
            'content' => 'New content',
        ]);
    }

    /**
     * Test admin user can delete a story.
     */
    public function test_admin_user_can_delete_story(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $story = Story::factory()->create();

        $response = $this->actingAs($admin)->delete("/admin/stories/{$story->id}");

        $response->assertRedirect('/admin/stories');
        $this->assertDatabaseMissing('stories', [
            'id' => $story->id,
        ]);
    }
}
