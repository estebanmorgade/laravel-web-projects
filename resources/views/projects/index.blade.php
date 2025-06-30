@extends('layout')

@isset($deletes)
    @section('title', 'Deletes')
@else
    @section('title', 'Portfolio') {{-- si pasamos el titulo como segundo parametro, evitas los espacios --}}
@endisset

{{--
@section('title')
    Portfolio
@endsection
--}}

@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        @isset($category)
            <h1 class="display-4 mb-0">{{ $category->name }}</h1>
        @else
            @isset($deletes)
                <h1 class="display-4 mb-0">{{ __(('Deletes')) }}</h1>
            @else
                <h1 class="display-4 mb-0">Portfolio</h1>
            @endisset
        @endisset

        {{--@can('create-projects') FORMA DE HACERLO CON GATES --}}
        @isset($newProject)
            @can('create', $newProject)
                <a class="btn btn-primary" href="{{route('projects.create')}}">Crear proyecto</a>
            @endcan
        @endisset    
       
    </div>

    <div class="container-fluid mt-4">
        <div class="d-flex flex-wrap justify-content-between align-items-start">
        {{-- forelse es como foreach pero premite agregar el empty para el caso de variable vacia --}}
            @forelse ($projects as $project)
                <div class="card border-0 shadow-sm mt-4 mx-auto" style="width: 18rem;">
                    <img src="/storage/{{ $project->image }}"
                        class="card-img-top"
                        alt="{{ $project->title }}"
                        style="height: 150px; object-fit: cover;"/>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ isset($deletes) ? route('projects.show-deleted', $project) : route('projects.show', $project) }}">
                                {{ $project->title }}
                            </a>
                        <h5>
                        <h6 class="card-subtitle">{{ $project->created_at->format('d/m/Y') }}</h6>
                        <p class="card-text text-truncate">{{ $project->description }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn btn-primary btn-sm"
                                href="{{ isset($deletes) ? route('projects.show-deleted', $project) : route('projects.show', $project) }}">
                                Ver más...
                            </a>
                            @if ($project->category_id)
                                <a href="{{ route('categories.show', $project->category) }}">
                                    <span class="badge text-bg-secondary">{{ $project->category->name }}</span>
                                </a>
                            @endif
                        </div>
                            
                    </div>
                </div>
            @empty
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">No proyects to display</h5>
                    </div>
                </div>
            @endforelse

        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $projects->links() }}
        </div>
    
    </div>
</div>


    
    
    
@endsection