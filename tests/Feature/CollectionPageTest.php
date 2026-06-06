<?php

namespace Tests\Feature;

use App\Models\CollectionItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CollectionPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public user can view collection listing page.
     */
    public function test_public_user_can_view_collection_page(): void
    {
        $items = CollectionItem::factory()->count(3)->create();

        $response = $this->get('/collection');

        $response->assertStatus(200);
        foreach ($items as $item) {
            $response->assertSee($item->title);
        }
    }

    /**
     * Test guest user cannot access admin collection endpoints.
     */
    public function test_unauthenticated_user_cannot_access_admin_collection_endpoints(): void
    {
        $response = $this->get('/admin/collections');
        $response->assertRedirect('/login');

        $response = $this->get('/admin/collections/create');
        $response->assertRedirect('/login');

        $response = $this->post('/admin/collections', []);
        $response->assertRedirect('/login');

        $response = $this->get('/admin/collections/1/edit');
        $response->assertRedirect('/login');

        $response = $this->put('/admin/collections/1', []);
        $response->assertRedirect('/login');

        $response = $this->delete('/admin/collections/1');
        $response->assertRedirect('/login');
    }

    /**
     * Test non-admin user is forbidden from admin collection endpoints.
     */
    public function test_non_admin_user_cannot_access_admin_collection_endpoints(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $item = CollectionItem::factory()->create();

        $response = $this->actingAs($user)->get('/admin/collections');
        $response->assertStatus(403);

        $response = $this->actingAs($user)->post('/admin/collections', []);
        $response->assertStatus(403);

        $response = $this->actingAs($user)->put("/admin/collections/{$item->id}", []);
        $response->assertStatus(403);

        $response = $this->actingAs($user)->delete("/admin/collections/{$item->id}");
        $response->assertStatus(403);
    }

    /**
     * Test admin user can access the collections list.
     */
    public function test_admin_user_can_access_admin_collection_list(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $item = CollectionItem::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/collections');

        $response->assertStatus(200);
        $response->assertSee($item->title);
    }

    /**
     * Test admin user can view the create form.
     */
    public function test_admin_user_can_view_create_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/collections/create');

        $response->assertStatus(200);
        $response->assertSee('Add Collection Item');
    }

    /**
     * Test admin user can store a new collection item.
     */
    public function test_admin_user_can_store_new_collection_item_with_image(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);
        $image = UploadedFile::fake()->image('statue.jpg');

        $response = $this->actingAs($admin)->post('/admin/collections', [
            'title' => 'Ancient Statue of Singhasari',
            'category' => 'Arca',
            'description' => 'A beautiful ancient stone statue.',
            'image' => $image,
        ]);

        $response->assertRedirect('/admin/collections');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('collection_items', [
            'title' => 'Ancient Statue of Singhasari',
            'category' => 'Arca',
            'description' => 'A beautiful ancient stone statue.',
        ]);

        // Verify stored file
        $item = CollectionItem::first();
        $this->assertNotNull($item->image);

        $relativePath = str_replace(asset('storage/'), '', $item->image);
        Storage::disk('public')->assertExists($relativePath);
    }

    /**
     * Test admin user can view the edit form.
     */
    public function test_admin_user_can_view_edit_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $item = CollectionItem::factory()->create();

        $response = $this->actingAs($admin)->get("/admin/collections/{$item->id}/edit");

        $response->assertStatus(200);
        $response->assertSee($item->title);
        $response->assertSee('Edit Collection Item');
    }

    /**
     * Test admin user can update a collection item.
     */
    public function test_admin_user_can_update_collection_item(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $item = CollectionItem::factory()->create([
            'title' => 'Old Title',
            'category' => 'Topeng',
            'description' => 'Old description',
        ]);

        $response = $this->actingAs($admin)->put("/admin/collections/{$item->id}", [
            'title' => 'New Title',
            'category' => 'Arca',
            'description' => 'New description',
        ]);

        $response->assertRedirect('/admin/collections');
        $this->assertDatabaseHas('collection_items', [
            'id' => $item->id,
            'title' => 'New Title',
            'category' => 'Arca',
            'description' => 'New description',
        ]);
    }

    /**
     * Test admin user can delete a collection item.
     */
    public function test_admin_user_can_delete_collection_item(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $item = CollectionItem::factory()->create();

        $response = $this->actingAs($admin)->delete("/admin/collections/{$item->id}");

        $response->assertRedirect('/admin/collections');
        $this->assertDatabaseMissing('collection_items', [
            'id' => $item->id,
        ]);
    }
}
