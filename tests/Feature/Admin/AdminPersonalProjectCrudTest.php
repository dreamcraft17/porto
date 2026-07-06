<?php

namespace Tests\Feature\Admin;

use App\Models\PersonalProject;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminPersonalProjectCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_personal_project_with_storage_upload(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create();

        $this->actingAs($admin)->post(route('admin.personal-projects.store'), [
            'title' => 'Side App',
            'description' => 'Personal side project',
            'content' => '<p>Rich <strong>content</strong></p>',
            'project_date' => '2024-03-01',
            'featured' => false,
            'image' => UploadedFile::fake()->image('side.jpg'),
        ])->assertRedirect(route('admin.personal-projects.index'));

        $project = PersonalProject::first();

        $this->assertNotNull($project);
        $this->assertEquals('side-app', $project->slug);
        $this->assertStringContainsString('<strong>', $project->content);
        $this->assertStringNotContainsString('<script>', $project->content);
        Storage::disk('public')->assertExists($project->image);
    }
}
