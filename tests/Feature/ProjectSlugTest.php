<?php

namespace Tests\Feature;

use App\Helpers\SlugHelper;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectSlugTest extends TestCase
{
    use RefreshDatabase;

    private function createProject(string $title, ?string $slug = null): Project
    {
        return Project::create([
            'title' => $title,
            'slug' => $slug ?? SlugHelper::generateUniqueSlug($title, Project::class),
            'description' => 'Description',
            'content' => 'Content',
            'project_date' => now()->toDateString(),
        ]);
    }

    public function test_duplicate_title_generates_incremented_slug(): void
    {
        $project1 = $this->createProject('My Portfolio');
        $this->assertEquals('my-portfolio', $project1->slug);

        $project2 = $this->createProject('My Portfolio');
        $this->assertEquals('my-portfolio-1', $project2->slug);

        $project3 = $this->createProject('My Portfolio');
        $this->assertEquals('my-portfolio-2', $project3->slug);
    }
}
