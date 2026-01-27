<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Certification;
use App\Models\PersonalProject; // Tambah ini
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $data = [
            'projects' => Project::orderBy('order', 'asc')
                ->where('featured', true)
                ->take(6)
                ->get(),
            'personalProjects' => PersonalProject::orderBy('order', 'asc') // Tambah ini
                ->where('featured', true)
                ->take(3)
                ->get(),
            'experiences' => Experience::orderBy('order', 'asc')
                ->orderBy('start_date', 'desc')
                ->get(),
            'skills' => Skill::orderBy('order', 'asc')
                ->orderBy('proficiency', 'desc')
                ->get(),
            'educations' => Education::orderBy('order', 'asc')
                ->orderBy('start_date', 'desc')
                ->get(),
            'certifications' => Certification::orderBy('order', 'asc')
                ->orderBy('issued_date', 'desc')
                ->get(),
        ];

        return view('portfolio.index', $data);
    }

    public function showProject($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $otherProjects = Project::where('id', '!=', $project->id)
            ->orderBy('order', 'asc')
            ->take(3)
            ->get();

        return view('portfolio.project', compact('project', 'otherProjects'));
    }

    public function showPersonalProject($slug) // Tambah method baru
    {
        $project = PersonalProject::where('slug', $slug)->firstOrFail();
        $otherProjects = PersonalProject::where('id', '!=', $project->id)
            ->orderBy('order', 'asc')
            ->take(3)
            ->get();

        return view('portfolio.personal-project', compact('project', 'otherProjects'));
    }

    public function allProjects()
    {
        $projects = Project::orderBy('order', 'asc')->paginate(9);
        return view('portfolio.projects', compact('projects'));
    }

    public function allPersonalProjects() // Tambah method baru
    {
        $projects = PersonalProject::orderBy('order', 'asc')->paginate(9);
        return view('portfolio.personal-projects', compact('projects'));
    }
}