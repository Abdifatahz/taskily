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

        <livewire:task :project="$project">
    </div>
@endsection
