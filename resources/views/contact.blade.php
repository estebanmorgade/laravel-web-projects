@extends('layout')

@section('title')
    Contact
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">

            {{--@if ($errors->any())
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul> 
            @endif--}} {{-- manera de mostrar todos los errores --}}


            <form class="bg-white shadow rounded py-3 px-4" action="{{ route(Route::currentRouteName()) }}" method="post">
                @csrf

                {{-- 2 formas de traducir texto(lang/es.json) --}}
                <h1 class="display-4">{{ __('Contact') }} {{-- - @lang('Contact')--}}</h1>
                <hr>

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input class="form-control bg-light shadow-sm @error('name') is-invalid @else border-0 @enderror"
                        type="text"
                        name="name"
                        placeholder="Nombre ..."
                        id="name"
                        value="{{ old("name") }}"> {{-- old sirve para recordar el valor ingresado anteriormente --}}
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                {{-- ESTA ES OTRA FORMA DE MOSTRAR LOS ERRORES --}}
                {{-- {!! $errors->first("name", '<small>:message</small>') !!} --}} {{-- agregamos las !! para que Blade no escape el HTML --}}
                </div>
                

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input class="form-control bg-light shadow-sm @error('email') is-invalid @else border-0 @enderror"
                        type="email"
                        name="email"
                        placeholder="Email ..."
                        id="email"
                        value="{{ old("email") }}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                

                <div class="mb-3">
                    <label for="subject" class="form-label">Asunto</label>
                    <input class="form-control bg-light shadow-sm @error('subject') is-invalid @else border-0 @enderror"
                        type="text"
                        name="subject"
                        placeholder="Asunto ..."
                        id="subject"
                        value="{{ old("subject") }}">
                    @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                

                <div class="mb-3">
                    <label for="content" class="form-label">Contenido</label>
                    <textarea class="form-control bg-light shadow-sm @error('content') is-invalid @else border-0 @enderror"
                        name="content"
                        placeholder="Mensaje ..."
                        id="content"
                        cols="30"
                        rows="10">
                        {{ old("content") }}
                    </textarea>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-grid d-block">
                    <button class="btn btn-primary btn-lg" type="submit">@lang('Send')</button>
                </div>
                
            </form>
        </div>
    </div>
</div>   
@endsection