<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        {{-- <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Menu</span>
        </button> --}}
        <a id="sidebarCollapse" class="navbar-brand text-black nav-linnk" href="#">
            <i class="fas fa-align-left"></i>
        </a>
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>
       

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                
                <!--No Authentication Links -->
                <!-- Authentication Links -->

                @if (Auth::check())
                    <li class="nav-item user-head">
                        <a id="navbarDropdown" class="nav-link" href="#">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right bg-primary"
                            aria-labelledby="navbarDropdown">

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                    <li class="nav-link active">
                        <a class="dropdown-item user-head" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            {{ __('SALIR') }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>