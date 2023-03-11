<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyCrudTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_company_create_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)->get('/companies/create');

        $response->assertStatus(200);
    }

    public function test_new_company_can_be_created_with_valid_data()
    {
        $user = User::factory()->create();
        $logo = UploadedFile::fake()->image('avatar.jpg', 100, 100);


        // creating fake storage
        Storage::fake('public');

        $response = $this
            ->actingAs($user)
            ->from('/companies/create')
            ->post('/companies', [
                'name' => 'wrong-password',
                'email' => 'new-password@gmail.com',
                'logo' => $logo
            ]);

        // Assert the file was stored...
        Storage::disk('public')->assertExists($logo->hashName());
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/companies');
    }
}
