<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Support\BooleanFields;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);
        $validated = BooleanFields::merge($request, $validated, ['active']);

        if (isset($validated['features'])) {
            $validated['features'] = array_values(array_filter($validated['features'], function ($feature) {
                return ! empty(trim((string) $feature));
            }));
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);
        $validated = BooleanFields::merge($request, $validated, ['active']);

        if (isset($validated['features'])) {
            $validated['features'] = array_values(array_filter($validated['features'], function ($feature) {
                return ! empty(trim((string) $feature));
            }));
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
