<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\PersonalProject;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Certification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'personal_projects' => PersonalProject::count(),
            'experiences' => Experience::count(),
            'skills' => Skill::count(),
            'education' => Education::count(),
            'certifications' => Certification::count(),
        ];

        $recentProjects = Project::latest()->take(5)->get();
        $recentPersonalProjects = PersonalProject::latest()->take(5)->get();

        return view('admin.dashboard.index', compact('stats', 'recentProjects', 'recentPersonalProjects'));
    }
}