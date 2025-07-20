<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookValidationTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_book_requires_fields()
    {
        $response = $this->postJson('/api/books', []);
        $response->assertStatus(422)->assertJsonValidationErrors(['title', 'author', 'published_year']);
    }
    public function test_only_admin_can_access_dashboard()
    {
        $user = User::factory()->create(['role' => 'user']);
        $this->actingAs($user)->get('/dashboard')->assertRedirect('/login');
    }
}
