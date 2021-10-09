<nav class="navbar navbar-expand-lg navbar-light top-navbar">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <i id="hamburger" class="fas fa-bars mr-4 opennav-btn" onclick="openNav()"></i>            
            <h3>@{{ $route.meta.title ? $route.meta.title : "BugTrack" }}</h3>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="username dropdown-toggle">
                <div class="user-pic">
                <img src="{{ asset('/images/profile-pic-sm.jpg') }}" alt="">
            </div>
            </div>
            
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

            <ul class="navbar-nav ml-auto mt-sm-3 mt-lg-0">
                <!-- Authentication Links -->
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="username dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ ucwords(Auth::user()->name) }}
                        <div class="user-pic">
                            <img src="{{ asset('/images/profile-pic-sm.jpg') }}" alt="">
                        </div>
                    </a>

                    @auth
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        <router-link to="/profile" class="dropdown-item">
                            <i class="fas fa-user-circle mr-2 link-fa"></i>
                            Profile
                        </router-link>

                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            <i class="fas fa-door-open mr-2 link-fa"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        
                    </div>
                    @endauth
                    
                </li>
            </ul>
        </div>
    </div>
</nav>