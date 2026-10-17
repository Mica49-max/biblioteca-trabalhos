<?php

namespace App\Http\Controllers;

use App\Enums\ProjectType;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Http\Request;

class PublicProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $selectedTypes = array_values(array_filter((array) $request->query('type', []), 'is_string'));
        $selectedTechnologies = array_values(array_filter((array) $request->query('technology', []), 'is_string'));

        $projects = Project::query()
            ->where('is_public', true)
            ->with('technologies')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($selectedTypes, fn ($query) => $query->whereIn('type', $selectedTypes))
            ->when($selectedTechnologies, function ($query) use ($selectedTechnologies) {
                $query->whereHas('technologies', fn ($q) => $q->whereIn('slug', $selectedTechnologies));
            })
            ->latest()
            ->get();

        $technologies = Technology::query()
            ->whereHas('projects', fn ($q) => $q->where('is_public', true))
            ->orderBy('name')
            ->get();

        return view('public.projects.index', [
            'projects' => $projects,
            'technologies' => $technologies,
            'types' => ProjectType::cases(),
            'selectedTypes' => $selectedTypes,
            'selectedTechnologies' => $selectedTechnologies,
        ]);
    }

    public function show(Project $project)
    {
        abort_unless($project->is_public, 404);

        $project->load('technologies');

        return view('public.projects.show', compact('project'));
    }
}