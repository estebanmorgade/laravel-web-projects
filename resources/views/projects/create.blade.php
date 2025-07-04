@extends('layout')

@section('title', __(('New Project')))

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">

            @include('partials.validation-errors')
            
            <form class="bg-white py-3 px-4 shadow rounded" enctype="multipart/form-data" action="{{route('projects.store')}}" method="post">
                
                <h1 class="display-4">{{__(('New project'))}}</h1>
                <hr>

                @include('projects._form')

                <div class="d-grid d-block">
                    <button class="btn btn-primary btn-lg" type="submit">@lang('Save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection