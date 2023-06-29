@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card border-0">
            <div class="card-body d-flex justify-content-between">
                <div class="mt-4">
                    <div class="mb-4">
                        <h1>{{ $project->name ?? '-' }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-0 mt-4">
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{ route('projects.show', $project->id) }}" class="mr-4"><i
                            class="icon ion-md-arrow-back"></i></a>
                    @lang('crud.tasks.edit_title')
                </h4>

                <x-form method="PUT" action="{{ route('tasks.update', [$project->id, $task]) }}" class="mt-4">
                    @include('app.tasks.form-inputs')

                    <div class="mt-4">
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
@endsection
