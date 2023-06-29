<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProjectController extends Controller
{
    /**
     * Display Only Owned Project listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Project::class);

        $projects = auth()->user()
            ->projects()
            ->withCount("tasks")
            ->latest()
            ->paginate(9);

        return view('app.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Project::class);

        return view('app.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Project::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string','unique:projects'],
        ]);

        $project = Project::create($validated + ['user_id' => auth::id()]);

        return redirect()
            ->route('projects.edit', $project)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Project $project): View
    {
        $this->authorize('view', $project);

        return view('app.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Project $project): View
    {
        $this->authorize('update', $project);

        return view('app.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project): RedirectResponse
    {
        $this->authorize('update', $project);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string','unique:projects,name,'.$project->id],
        ]);

        $project->update($validated);

        return redirect()
            ->route('projects.edit', $project)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Project $project
    ): RedirectResponse {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
