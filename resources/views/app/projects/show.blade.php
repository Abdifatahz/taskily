@extends('layouts.app')

@section('content')
    <div class="container col-sm-6">
        <div class="card border-0">
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
                        <a href="{{ route('tasks.create', $project->id) }}" class="btn btn-light">
                            <i class="icon ion-md-add"></i> Add new task
                        </a>
                    @endcan
                </div>


            </div>
        </div>
        <ul class="list-group rounded-0 my-4 border-0">
            <button type="button" class="list-group-item list-group-item-action active bg-dark text-light border-0">
                Tasks
            </button>
            @forelse ($project->tasks as $task)
                <li class="list-group-item border-0 m-0 py-2">
                    <div class="d-flex justify-content-between align-items-center align-self-baseline">
                        <p class="col-sm-6">{{ $task->name }}</p>
                        <span class="badge badge-info pt-2" style="width:10%">{{ strtoupper($task->priority) }}</span>
                        <div class="d-flex justify-content-around">
                            @can('update', $task)
                                <a href="{{ route('tasks.edit', [$project->id, $task]) }}">
                                    <button type="button" class="btn btn-light mx-1">
                                        <i class="icon ion-md-create"></i>
                                    </button>
                                </a>
                            @endcan
                            @can('delete', $task)
                                <form action="{{ route('tasks.destroy', [$project->id, $task]) }}" method="POST"
                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-light text-danger">
                                        <i class="icon ion-md-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </li>
            @empty
                <p>No tasks in this projects</p>
            @endforelse
        </ul>
    </div>
@endsection
