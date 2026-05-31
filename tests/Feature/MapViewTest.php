<?php

namespace Tests\Feature;

use Tests\TestCase;

class MapViewTest extends TestCase
{
    /**
     * Test that the map page is accessible.
     */
    public function test_map_page_loads_successfully(): void
    {
        $response = $this->get(route('map'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.map');
        $response->assertSee('Daftar Area Museum');
    }
}
