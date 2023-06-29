@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body d-flex justify-content-between">
                <div class="mt-4">
                    <div class="mb-4">
                        <h1>{{ $project->name ?? '-' }}</h1>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('projects.index') }}" class="btn btn-light">
                        <i class="icon ion-md-return-left"></i>
                        @lang('crud.projects.name')
                    </a>

                    @can('create', App\Models\Project::class)
                        <a href="{{ route('projects.create') }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> Add new task
                        </a>
                    @endcan
                </div>


            </div>
        </div>
        <ul class="list-group rounded-0 my-4 ">
            <button type="button" class="list-group-item list-group-item-action active">
                Tasks
            </button>
            @forelse ($project->tasks as $task)
                <li class="list-group-item">{{ $task->name }}</li>
            @empty
                <p>No tasks in this projects</p>
            @endforelse
        </ul>
    </div>
@endsection
