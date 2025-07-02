@extends('layout')

@section('title', 'Home')

@section('content')

    <div class="container">
      <div class="row">
        
        <div class="col-12 col-lg-6">
            <h1 class="display-4 text-primary">Desarrollo web</h1>
            <p class="lead text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
              Eum soluta, illum fuga deserunt nobis voluptatem aut cum laudantium quidem. 
              Earum, illum omnis quasi alias dolores rerum aut dolorem tempora amet?
            </p>
            <div class="d-flex flex-column gap-2">
                <a class="btn btn-lg btn-primary" href="{{ route('contact') }}">{{__('Contactame')}}</a>
                <a class="btn btn-lg btn-outline-primary" href="{{ route('projects.index') }}">{{__('Projects')}}</a>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <img class="img-fluid" src="/img/home.svg" alt="Desarrollo web">
        </div>

      </div>
    </div>
    
    {{-- ACCEDER AL METODO USER DE LA CLASE AUTH
      @auth
        {{ Auth::user()->name }} 
      @endauth
    --}}

@endsection