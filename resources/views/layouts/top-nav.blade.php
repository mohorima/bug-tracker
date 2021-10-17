<nav class="navbar navbar-expand-lg navbar-light top-navbar">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <div class="closebtn">
                <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="15" cy="15" r="15" fill="#596152"/>
                    <path d="M16.83 22C16.6806 22.0005 16.533 21.9675 16.398 21.9035C16.263 21.8395 16.1441 21.746 16.05 21.63L11.22 15.63C11.0729 15.4511 10.9925 15.2266 10.9925 14.995C10.9925 14.7634 11.0729 14.5389 11.22 14.36L16.22 8.36C16.3898 8.15578 16.6337 8.02736 16.8981 8.00298C17.1625 7.9786 17.4258 8.06026 17.63 8.23C17.8342 8.39974 17.9627 8.64365 17.987 8.90808C18.0114 9.1725 17.9297 9.43578 17.76 9.64L13.29 15L17.61 20.36C17.7323 20.5068 17.81 20.6855 17.8339 20.8751C17.8577 21.0646 17.8268 21.257 17.7448 21.4296C17.6627 21.6021 17.5329 21.7475 17.3708 21.8486C17.2087 21.9497 17.021 22.0022 16.83 22Z" fill="#FAFAF8"/>
                </svg>   
            </div>     
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