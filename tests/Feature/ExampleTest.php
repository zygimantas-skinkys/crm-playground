<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_returns_successful_response(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function test_homepage_displays_application_name(): void
    {
        $response = $this->get(route('home'));

        $response->assertSee(config('app.name'));
    }

    public function test_homepage_includes_link_to_companies(): void
    {
        $response = $this->get(route('home'));

        $response->assertSee(route('companies.index'));
    }

    public function test_homepage_shows_welcome_message(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }
}
