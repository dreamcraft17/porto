<?php

namespace Tests\Unit;

use App\Helpers\SlugHelper;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SlugHelperTest extends TestCase
{
    use RefreshDatabase;

    public function test_generates_slug_from_title(): void
    {
        $slug = SlugHelper::generateUniqueSlug('My Portfolio', Project::class);

        $this->assertEquals('my-portfolio', $slug);
    }

    public function test_excludes_current_record_when_updating(): void
    {
        $project = Project::create([
            'title' => 'My Portfolio',
            'slug' => 'my-portfolio',
            'description' => 'Description',
            'content' => 'Content',
            'project_date' => now()->toDateString(),
        ]);

        $slug = SlugHelper::generateUniqueSlug('My Portfolio', Project::class, $project->id);

        $this->assertEquals('my-portfolio', $slug);
    }
}
