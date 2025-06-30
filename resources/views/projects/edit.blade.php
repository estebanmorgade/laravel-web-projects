@extends('layout')

@section('title', 'Editar proyecto')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">


            @include('partials.validation-errors')
                
            <form class="bg-white py-3 px-4 shadow rounded"
                enctype="multipart/form-data"
                action="{{route('projects.update', $project)}}"
                method="post">

                @method('PUT')

                <h1 class="display-4">Editar proyecto</h1>
                <hr>
                
                @include('projects._form')

                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-primary btn-lg" type="submit">Actualizar</button>
                    <a class="btn btn-link" href="{{ route('projects.index') }}">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection