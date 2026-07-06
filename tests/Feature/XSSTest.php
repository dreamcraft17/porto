<?php

namespace Tests\Feature;

use App\Models\PersonalProject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class XSSTest extends TestCase
{
    use RefreshDatabase;

    public function test_personal_project_content_is_sanitized_on_save(): void
    {
        $malicious = '<script>alert("XSS")</script><p>Safe text</p>';

        $project = PersonalProject::create([
            'title' => 'Test Project',
            'slug' => 'test-project',
            'description' => 'Test description',
            'content' => $malicious,
            'project_date' => now()->toDateString(),
        ]);

        $this->assertStringNotContainsString('<script>', $project->fresh()->content);

        $response = $this->get(route('personal.project.show', $project->slug));

        $response->assertStatus(200);
        $response->assertSee('Safe text', false);
        $response->assertDontSee('alert("XSS")', false);
        $this->assertStringNotContainsString('<script>', $project->fresh()->content);
    }
}
