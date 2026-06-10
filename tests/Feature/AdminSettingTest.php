<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminSettingTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that guest users cannot update settings.
     */
    public function test_guest_cannot_update_settings(): void
    {
        $response = $this->post(route('admin.settings.update'), [
            'dashboard_museum_image' => UploadedFile::fake()->image('museum.jpg'),
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('settings', ['key' => 'dashboard_museum_image']);
    }

    /**
     * Test that non-admin users cannot update settings.
     */
    public function test_non_admin_cannot_update_settings(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $response = $this->actingAs($user)->post(route('admin.settings.update'), [
            'dashboard_museum_image' => UploadedFile::fake()->image('museum.jpg'),
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('settings', ['key' => 'dashboard_museum_image']);
    }

    /**
     * Test that admin can update settings and upload cover images.
     */
    public function test_admin_can_update_settings_and_upload_images(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post(route('admin.settings.update'), [
            'dashboard_museum_image' => UploadedFile::fake()->image('museum.jpg'),
            'dashboard_collections_image' => UploadedFile::fake()->image('collections.png'),
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('success');

        // Check DB
        $museumPath = Setting::get('dashboard_museum_image');
        $collectionsPath = Setting::get('dashboard_collections_image');

        $this->assertNotNull($museumPath);
        $this->assertNotNull($collectionsPath);

        // Verify storage
        Storage::disk('public')->assertExists($museumPath);
        Storage::disk('public')->assertExists($collectionsPath);
    }

    /**
     * Test that admin can reset/delete settings.
     */
    public function test_admin_can_reset_settings(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'admin']);

        // Upload first
        $response = $this->actingAs($admin)->post(route('admin.settings.update'), [
            'dashboard_museum_image' => UploadedFile::fake()->image('museum.jpg'),
        ]);

        $museumPath = Setting::get('dashboard_museum_image');
        $this->assertNotNull($museumPath);
        Storage::disk('public')->assertExists($museumPath);

        // Now delete it
        $response2 = $this->actingAs($admin)->post(route('admin.settings.update'), [
            'delete_dashboard_museum_image' => '1',
        ]);

        $response2->assertRedirect(route('admin.dashboard'));
        $this->assertNull(Setting::get('dashboard_museum_image'));
        Storage::disk('public')->assertMissing($museumPath);
    }
}
