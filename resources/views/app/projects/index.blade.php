@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 m-2">
            @can('create', App\Models\Project::class)
                <a href="{{ route('projects.create') }}" class="btn btn-dark">
                    <i class="icon ion-md-add"></i>
                    @lang('crud.common.create')
                </a>
            @endcan
        </div>
        <div class="d-flex justify-content-start flex-wrap">
            @forelse($projects as $project)
                <div class="card text-dark bg-white m-4 h-64 col-sm-3" style="min-height:150px;border:none">
                    <div class="card-body p-4 bg-white b-0">
                        <h5 class="card-title">{{ $project->name ?? '-' }}</h5>
                        <span>{{ $project->tasks_count }} Tasks</span>
                        @can('view', $project)
                            <a href="{{ route('projects.show', $project) }}">
                                <button type="button" class="btn">
                                    <i class="icon ion-md-eye"></i>
                                </button>
                            </a>
                        @endcan
                    </div>

                    <div class="card-footer bg-white m-0 p-0">
                        <div class="d-flex justify-content-start">
                            @can('update', $project)
                                <a href="{{ route('projects.edit', $project) }}">
                                    <button type="button" class="btn">
                                        <i class="icon ion-md-create"></i>
                                    </button>
                                </a>
                            @endcan

                            @can('delete', $project)
                                <form action="{{ route('projects.destroy', $project) }}" method="POST"
                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn text-danger">
                                        <i class="icon ion-md-trash"></i>
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <p>No Projects Found</p>
            @endforelse
        </div>

        {!! $projects->render() !!}
    </div>
@endsection
