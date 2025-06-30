@extends('layout')

@section('title', 'Deletes')


@section('content')

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="display-4 mb-0">{{ __(('Deletes')) }}</h1>       
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
                            <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                        <h5>
                        <h6 class="card-subtitle">{{ $project->created_at->format('d/m/Y') }}</h6>
                        <p class="card-text text-truncate">{{ $project->description }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <a class="btn btn-primary btn-sm" href="{{ route('projects.show', $project) }}">Ver más...</a>
                            @if ($project->category_id)
                                <span class="badge text-bg-secondary">{{ $project->category->name }}</span>
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