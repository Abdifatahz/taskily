<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Project $project): View
    {
        $this->authorize('create', [Task::class, $project]);

        $users = User::pluck('name', 'id');

        return view('app.tasks.create', compact('project', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Project $project): RedirectResponse
    {

        $this->authorize('create', [Task::class, $project]);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string','unique:tasks,name'],
            'priority' => ['required', 'in:low,medium,heigh'],
        ]);

        // New Task will be added after least priority one
        $task_position   =    $project->tasks()
                ->orderByDesc("position")
                ->pluck("position")
                ->first();

        // Data that not coming from form
        $dynamic  = [
                   'user_id'    => auth::id(),
                   'project_id' => $project->id,
                   'position'   => $task_position
        ];

        $task = Task::create($validated + $dynamic);

        return redirect()
            ->route('projects.show', $project->id)
            ->withSuccess(__('crud.common.created'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Project $project, Task $task): View
    {
        $this->authorize('update', $task);

        $projects = Project::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('app.tasks.edit', compact('task', 'project', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project, Task $task): RedirectResponse
    {
        $this->authorize('update', $task);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string','unique:tasks,name,'.$task->id],
            'priority' => ['required', 'in:low,medium,heigh'],
        ]);

        $task->update($validated);

        return redirect()
            ->route('projects.show', $project->id)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Project $project, Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()
            ->route('projects.show', $project->id)
            ->withSuccess(__('crud.common.removed'));
    }
}
