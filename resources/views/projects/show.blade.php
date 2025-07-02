@extends('layout')

@section('title', $project->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-8 mx-auto">
                <div class="card bg-white shadow border-0">
                    @if ($project->image)
                        <img class="card-img-top" src="/storage/{{$project->image}}" alt="{{$project->title}}">
                    @endif

                    <div class="card-body">
                        <h1 class="card-title">{{ $project->title }}
                            @if ($project->category_id)
                                <a href="{{ route('categories.show', $project->category) }}">
                                    <span class="badge text-bg-secondary">
                                        {{ $project->category->name }}
                                    </span>
                                </a>
                            @endif
                        </h1>
                        
                        <p class="text-secondary">{{ $project->description }}</p>
                        <p class="text-black-50">{{ $project->created_at->diffForHumans() }}</p>


                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('projects.index') }}">{{__(('Return'))}}</a>
                        @auth
                            <div class="btn-group btn-group-sm">
                                @can('update', $project)
                                    <a class="btn btn-primary" href="{{ route('projects.edit', $project) }}">{{__(('Edit'))}}</a>
                                @endcan

                                @can('delete', $project)
                                    <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-project').submit()">{{__(('Delete'))}}</a>
                                @endcan
                            </div>
                            @can('delete', $project)
                                <form class="d-none" id="delete-project" action="{{ route('projects.destroy', $project) }}" method="post">
                                    @csrf @method('DELETE')
                                </form>
                            @endcan
                            
                        @endauth
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection