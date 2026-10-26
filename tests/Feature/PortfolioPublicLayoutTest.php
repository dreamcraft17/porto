<?php

namespace Tests\Feature;

use App\Helpers\SlugHelper;
use App\Models\PersonalProject;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortfolioPublicLayoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_uses_portfolio_shell_without_legacy_navbar(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('site-rail', false);
        $response->assertSee('intro-title', false);
        $response->assertSee('I build software that keeps real teams moving.', false);
        $response->assertSee('dntech.id', false);
        $response->assertSee('Managed by', false);
        $response->assertDontSee('navbar-bold', false);
        $response->assertDontSee('footer-bold', false);
        $response->assertDontSee('bootstrap@5.3.0', false);
    }

    public function test_project_archive_uses_unified_header(): void
    {
        $response = $this->get('/projects');

        $response->assertOk();
        $response->assertSee('site-rail', false);
        $response->assertSee('Systems shipped for teams and clients.', false);
        $response->assertDontSee('navbar-bold', false);
    }

    public function test_not_found_page_uses_editorial_tokens(): void
    {
        $response = $this->get('/this-route-should-not-exist-porto-test');

        $response->assertNotFound();
        $response->assertSee('site-rail', false);
        $response->assertSee('404', false);
        $response->assertSee('Kembali ke portfolio', false);
        $response->assertDontSee('#8b5cf6', false);
        $response->assertDontSee('bootstrap@5.3.0', false);
    }

    public function test_home_shows_stack_breadth_when_skills_empty(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Stack breadth', false);
        $response->assertSee('proof-value">Full<', false);
        $response->assertDontSee('proof-value">0+<', false);
    }

    public function test_personal_projects_archive_uses_portfolio_shell(): void
    {
        $response = $this->get('/personal-projects');

        $response->assertOk();
        $response->assertSee('site-rail', false);
        $response->assertDontSee('navbar-bold', false);
    }

    public function test_project_detail_uses_portfolio_shell(): void
    {
        $project = Project::create([
            'title' => 'QA Case Study',
            'slug' => SlugHelper::generateUniqueSlug('QA Case Study', Project::class),
            'description' => 'Short summary',
            'content' => '<p>Body</p>',
            'project_date' => now()->toDateString(),
        ]);

        $response = $this->get('/project/'.$project->slug);

        $response->assertOk();
        $response->assertSee('site-rail', false);
        $response->assertSee('QA Case Study', false);
        $response->assertDontSee('bootstrap@5.3.0', false);
    }

    public function test_personal_project_detail_uses_portfolio_shell(): void
    {
        $project = PersonalProject::create([
            'title' => 'Side Project QA',
            'slug' => 'side-project-qa',
            'description' => 'Summary',
            'content' => '<p>Notes</p>',
            'project_date' => now()->toDateString(),
        ]);

        $response = $this->get('/personal-project/'.$project->slug);

        $response->assertOk();
        $response->assertSee('site-rail', false);
        $response->assertSee('Side Project QA', false);
    }
}
