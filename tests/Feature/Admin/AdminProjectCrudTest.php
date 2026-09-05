<?php

namespace Tests\Feature\Admin;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminProjectCrudTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create();
    }

    public function test_guest_cannot_access_admin_projects(): void
    {
        $this->get(route('admin.projects.index'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_project_with_unique_slug(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin)->post(route('admin.projects.store'), [
            'title' => 'POS Dashboard',
            'description' => 'Point of sale dashboard',
            'content' => 'Detailed project content',
            'project_date' => '2024-01-15',
            'featured' => true,
            'image' => UploadedFile::fake()->image('project.jpg'),
        ]);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', [
            'title' => 'POS Dashboard',
            'slug' => 'pos-dashboard',
        ]);
        $project = Project::first();
        $this->assertNotNull($project);
        Storage::disk('public')->assertExists($project->image);
    }

    public function test_admin_can_update_and_delete_project(): void
    {
        $project = Project::create([
            'title' => 'Original',
            'slug' => 'original',
            'description' => 'Desc',
            'content' => 'Content',
            'project_date' => now()->toDateString(),
        ]);

        $this->actingAs($this->admin)->put(route('admin.projects.update', $project), [
            'title' => 'Updated Title',
            'description' => 'Updated desc',
            'content' => 'Updated content',
            'project_date' => '2024-02-01',
        ])->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'slug' => 'updated-title',
        ]);

        $this->actingAs($this->admin)->delete(route('admin.projects.destroy', $project))
            ->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_unchecking_featured_persists_false(): void
    {
        $project = Project::create([
            'title' => 'Featured Work',
            'slug' => 'featured-work',
            'description' => 'Desc',
            'content' => 'Content',
            'project_date' => now()->toDateString(),
            'featured' => true,
        ]);

        $this->actingAs($this->admin)->put(route('admin.projects.update', $project), [
            'title' => 'Featured Work',
            'description' => 'Desc',
            'content' => 'Content',
            'project_date' => '2024-02-01',
        ])->assertRedirect(route('admin.projects.index'));

        $this->assertFalse($project->fresh()->featured);
    }

    public function test_non_admin_cannot_access_project_admin(): void
    {
        $user = User::factory()->notAdmin()->create();

        $this->actingAs($user)->get(route('admin.projects.index'))
            ->assertForbidden();
    }
}
