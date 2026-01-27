<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonalProject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PersonalProjectController extends Controller
{

    
    public function index()
    {
        $projects = PersonalProject::orderBy('order')->get();
        return view('admin.personal-projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.personal-projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'technologies' => 'nullable|array',
            'project_date' => 'required|date',
            'order' => 'nullable|integer',
            'featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('personal-projects', 'public');
            $validated['image'] = $path;
        }

        if (isset($validated['technologies'])) {
            $validated['technologies'] = json_encode($validated['technologies']);
        }

        PersonalProject::create($validated);

        return redirect()->route('admin.personal-projects.index')->with('success', 'Personal project created successfully.');
    }

    public function edit(PersonalProject $personalProject)
    {
        return view('admin.personal-projects.edit', compact('personalProject'));
    }

    public function update(Request $request, PersonalProject $personalProject)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'technologies' => 'nullable|array',
            'project_date' => 'required|date',
            'order' => 'nullable|integer',
            'featured' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            if ($personalProject->image) {
                \Storage::disk('public')->delete($personalProject->image);
            }
            
            $path = $request->file('image')->store('personal-projects', 'public');
            $validated['image'] = $path;
        }

        if (isset($validated['technologies'])) {
            $validated['technologies'] = json_encode($validated['technologies']);
        }

        $personalProject->update($validated);

        return redirect()->route('admin.personal-projects.index')->with('success', 'Personal project updated successfully.');
    }

    public function destroy(PersonalProject $personalProject)
    {
        if ($personalProject->image) {
            \Storage::disk('public')->delete($personalProject->image);
        }
        
        $personalProject->delete();

        return redirect()->route('admin.personal-projects.index')->with('success', 'Personal project deleted successfully.');
    }
}