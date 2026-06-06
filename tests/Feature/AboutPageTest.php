<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the /about page is accessible and returns a successful response.
     */
    public function test_about_page_returns_successful_response(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee('About Museum Singhasari');
        $response->assertSee('Our Mission');
        $response->assertSee('Preserve Heritage');
        $response->assertSee('What You Can Explore');
        $response->assertSee('Preserving the past, inspiring the future.');
    }
}
