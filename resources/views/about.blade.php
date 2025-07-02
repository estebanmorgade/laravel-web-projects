@extends('layout')

@section('title')
    @lang('About')
@endsection

@section('content')

<div class="container">
      <div class="row">

        <div class="col-12 col-lg-6">
            <img class="img-fluid" src="/img/about.svg" alt="Quién soy">
        </div>
        
        <div class="col-12 col-lg-6">
            <h1 class="display-4 text-primary">{{__('About')}}</h1>
            <p class="lead text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
              Eum soluta, illum fuga deserunt nobis voluptatem aut cum laudantium quidem. 
              Earum, illum omnis quasi alias dolores rerum aut dolorem tempora amet?
            </p>
            <div class="d-flex flex-column gap-2">
                <a class="btn btn-lg btn-primary" href="{{ route('contact') }}">{{__('Contact')}}</a>
                <a class="btn btn-lg btn-outline-primary" href="{{ route('projects.index') }}">{{__('Projects')}}</a>
            </div>
        </div>

      </div>
    </div>
    
@endsection