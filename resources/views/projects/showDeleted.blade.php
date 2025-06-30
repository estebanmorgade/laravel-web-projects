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
                            <a href="{{ route('projects.index',['deletes' => 'true']) }}">Regresar</a>
                        @auth
                            <div class="btn-group btn-group-sm">
                                <form action="{{ route('projects.restore', $project) }}" method="post">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-primary" type="submit">Restaurar</button>
                                </form>

                                <form onsubmit="return confirm('¿Estás seguro de ejecutar esta acción?')"
                                    action="{{ route('projects.force-delete', $project) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Eliminar</button>
                                </form>
                            </div>
                            
                        @endauth
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection