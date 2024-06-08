<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use DatabaseTransactions;

    public function testValidateSubmissionData()
    {
        $response = $this->postJson('/api/submit', [
            'name' => '',
            'email' => 'invalid-email',
            'message' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'message']);
    }

    public function testQueueSubmissionForProcessing()
    {
        $data = [
            'name' => 'Dummy Name',
            'email' => 'dummy@example.com',
            'message' => 'Some test message text.',
        ];

        $response = $this->postJson('/api/submit', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'The submission queued to be processed.']);

        $this->assertDatabaseHas('submissions', $data);
    }
}
