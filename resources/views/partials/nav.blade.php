<nav class="navbar navbar-expand-lg bg-white shadow-sm py-lg-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">{{config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav nav-pills">
                <li class="nav-item"><a class="nav-link {{ setActive('home') }}" href="/">@lang('Home')</a></li>
                <li class="nav-item"><a class="nav-link {{ setActive('contact') }}" href="{{ route("contact") }}">@lang('Contact')</a></li>
                <li class="nav-item"><a class="nav-link {{ setActive('about') }}" href="{{ route("about") }}">@lang('About')</a></li>
                <li class="nav-item"><a class="nav-link {{ setActive('projects.*') }}" href="{{ route("projects.index") }}">@lang('Projects')</a></li>
                @guest
                  <li class="nav-item"><a class="nav-link" href="{{ route("login") }}">Login</a></li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}</a>
                    </li> 
                @endguest
            </ul>
        </div>
        
    </div>
    
</nav>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>