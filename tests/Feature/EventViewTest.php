<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventViewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user can view the details of an event.
     */
    public function test_user_can_view_event_details(): void
    {
        $event = Event::create([
            'title' => 'Pameran Candi Jago',
            'description' => 'Eksplorasi relief candi peninggalan Singhasari.',
            'category' => 'Pameran Khusus',
            'event_date' => '2026-07-10',
            'location' => 'Ruang Arca Tengah',
            'duration' => '2 Minggu',
        ]);

        $response = $this->get(route('events.show', $event));

        $response->assertStatus(200);
        $response->assertViewIs('pages.events.show');
        $response->assertSee('Pameran Candi Jago');
        $response->assertSee('Eksplorasi relief candi peninggalan Singhasari.');
        $response->assertSee('Pameran Khusus');
        $response->assertSee('Ruang Arca Tengah');
        $response->assertSee('2 Minggu');
    }

    /**
     * Test guest user cannot access admin events endpoints.
     */
    public function test_unauthenticated_user_cannot_access_admin_events_endpoints(): void
    {
        $response = $this->get('/admin/events');
        $response->assertRedirect('/login');

        $response = $this->get('/admin/events/create');
        $response->assertRedirect('/login');

        $response = $this->post('/admin/events', []);
        $response->assertRedirect('/login');

        $response = $this->get('/admin/events/1/edit');
        $response->assertRedirect('/login');

        $response = $this->put('/admin/events/1', []);
        $response->assertRedirect('/login');

        $response = $this->delete('/admin/events/1');
        $response->assertRedirect('/login');
    }

    /**
     * Test non-admin user is forbidden from admin events endpoints.
     */
    public function test_non_admin_user_cannot_access_admin_events_endpoints(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $event = Event::create([
            'title' => 'Test Title',
            'description' => 'Test description',
        ]);

        $response = $this->actingAs($user)->get('/admin/events');
        $response->assertStatus(403);

        $response = $this->actingAs($user)->post('/admin/events', []);
        $response->assertStatus(403);

        $response = $this->actingAs($user)->put("/admin/events/{$event->id}", []);
        $response->assertStatus(403);

        $response = $this->actingAs($user)->delete("/admin/events/{$event->id}");
        $response->assertStatus(403);
    }

    /**
     * Test admin user can access the events list.
     */
    public function test_admin_user_can_access_admin_events_list(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $event = Event::create([
            'title' => 'Exhibition Title',
            'description' => 'Exhibition Description',
        ]);

        $response = $this->actingAs($admin)->get('/admin/events');

        $response->assertStatus(200);
        $response->assertSee('Exhibition Title');
    }

    /**
     * Test admin user can view the create form.
     */
    public function test_admin_user_can_view_events_create_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin/events/create');

        $response->assertStatus(200);
        $response->assertSee('Create Event');
    }

    /**
     * Test admin user can view the edit form.
     */
    public function test_admin_user_can_view_events_edit_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $event = Event::create([
            'title' => 'Exhibition Edit Title',
            'description' => 'Exhibition Edit Description',
        ]);

        $response = $this->actingAs($admin)->get("/admin/events/{$event->id}/edit");

        $response->assertStatus(200);
        $response->assertSee('Exhibition Edit Title');
        $response->assertSee('Edit Event');
    }

    /**
     * Test admin user can store a new event.
     */
    public function test_admin_user_can_store_new_event(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->post('/admin/events', [
            'title' => 'New Event Title',
            'category' => 'Pameran Terbaru',
            'event_date' => '2026-08-20',
            'location' => 'Galeri Singhasari',
            'duration' => '4 Bulan',
            'description' => 'Full event description goes here.',
        ]);

        $response->assertRedirect('/admin/events');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('events', [
            'title' => 'New Event Title',
            'category' => 'Pameran Terbaru',
            'event_date' => '2026-08-20 00:00:00',
            'location' => 'Galeri Singhasari',
            'duration' => '4 Bulan',
            'description' => 'Full event description goes here.',
        ]);
    }

    /**
     * Test admin user can update an event.
     */
    public function test_admin_user_can_update_event(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $event = Event::create([
            'title' => 'Old Event Title',
            'category' => 'Old Category',
            'event_date' => '2026-05-01',
            'location' => 'Old Location',
            'duration' => 'Old Duration',
            'description' => 'Old Description',
        ]);

        $response = $this->actingAs($admin)->put("/admin/events/{$event->id}", [
            'title' => 'New Event Title',
            'category' => 'New Category',
            'event_date' => '2026-09-01',
            'location' => 'New Location',
            'duration' => 'New Duration',
            'description' => 'New Description',
        ]);

        $response->assertRedirect('/admin/events');
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'title' => 'New Event Title',
            'category' => 'New Category',
            'event_date' => '2026-09-01 00:00:00',
            'location' => 'New Location',
            'duration' => 'New Duration',
            'description' => 'New Description',
        ]);
    }

    /**
     * Test admin user can delete an event.
     */
    public function test_admin_user_can_delete_event(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $event = Event::create([
            'title' => 'Event to Delete',
            'description' => 'To be deleted',
        ]);

        $response = $this->actingAs($admin)->delete("/admin/events/{$event->id}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('events', [
            'id' => $event->id,
        ]);
    }
}
