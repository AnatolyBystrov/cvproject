<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateControllerTest extends TestCase
{
    /** @test */
    public function it_generates_a_pdf_with_valid_data()
    {
        $response = $this->postJson('/api/generate', [
            'name' => 'Anatoly',
            'position' => 'Backend Developer',
            'experience' => '5 years',
            'education' => 'BSc CS',
            'skills' => 'PHP, Laravel, Docker',
            'hobbies' => 'Reading',
            'cover_letter' => 'I am passionate about backend development.'
        ]);

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    /** @test */
    public function it_returns_validation_error_for_missing_required_fields()
    {
        $response = $this->postJson('/api/generate', [
            'name' => 'Anatoly',
            // 'position' => 'Backend Developer', // intentionally missing
            // 'cover_letter' => '...' // intentionally missing
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['position', 'cover_letter']);
    }

    public function test_it_returns_pdf_response_headers()
{
    $response = $this->postJson('/api/generate', [
        'name' => 'Test User',
        'position' => 'Tester',
        'cover_letter' => 'Test Cover Letter'
    ]);

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/pdf');
}

public function test_it_fails_on_empty_payload()
{
    $response = $this->postJson('/api/generate', []);
    $response->assertStatus(422);
    $response->assertJsonValidationErrors(['name', 'position', 'cover_letter']);
}

public function test_it_handles_special_characters_in_input()
{
    $response = $this->postJson('/api/generate', [
        'name' => '<script>alert("xss")</script>',
        'position' => 'Developer',
        'cover_letter' => 'Cover with <b>bold</b>'
    ]);

    $response->assertStatus(200);
    $response->assertHeader('Content-Type', 'application/pdf');
}


}
