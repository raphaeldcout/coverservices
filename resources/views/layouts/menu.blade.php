@php
$route = Route::current()->getName();
$route_view = ucwords(str_replace('_', ' ', $route));
@endphp
<div class="sidebar" data-color="azure" data-background-color="white">
    <div class="logo">
        <a href="{{ url('/') }}" class="simple-text logo-normal">
            <img src="/img/logo.png" alt="logo">
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @if(Auth::user()->hierarquia == 2 || Auth::user()->hierarquia == 3)
            <li class="nav-item @if($route == 'dashboard') active @endif">
                <a class="nav-link" href="{{ url('/') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item @if($route == 'gerenciar_chamados') active @endif">
            <a class="nav-link" href="{{ url('/acompanhar/chamados') }}">
                    <i class="material-icons">build</i>
                    <p>Gerenc. Chamados</p>
                </a>
            </li>
            @endif

            @if(Auth::user()->hierarquia == 3)
            <li class="nav-item @if($route == 'usuario') active @endif">
                <a class="nav-link" href="{{ url('/usuario') }}">
                    <i class="material-icons">person_add</i>
                    <p>Usuário</p>
                </a>
            </li>
            <li class="nav-item @if($route == 'setor') active @endif">
                <a class="nav-link" href="{{ url('/setor') }}">
                    <i class="material-icons">account_tree</i>
                    <p>Setor</p>
                </a>
            </li>
            <li class="nav-item @if($route == 'categoria') active @endif">
                <a class="nav-link" href="{{ url('/categoria') }}">
                    <i class="material-icons">backup_table</i>
                    <p>Categoria</p>
                </a>
            </li>
            <li class="nav-item @if($route == 'problema') active @endif">
                <a class="nav-link" href="{{ url('/problema') }}">
                    <i class="material-icons">calculate</i>
                    <p>Problemas</p>
                </a>
            </li>
            <hr>
            @endif
            <li class="nav-item @if($route == 'chamados') active @endif">
                <a class="nav-link" href="{{ url('/chamados') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Abrir Chamados</p>
                </a>
            </li>            
            <li class="nav-item @if($route == 'acompanhar_chamados') active @endif">
                <a class="nav-link" href="{{ url('/acompanhar/chamados') }}">
                    <i class="material-icons">fact_check</i>
                    <p>Acomp. Chamados</p>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="main-panel">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
            <div class="navbar-wrapper">
                <a class="navbar-brand" href="javascript:;">{{ ucwords($route_view) }}</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
                <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">
                <form class="navbar-form">
                    <div class="input-group no-border">
                        <input type="text" value="" class="form-control" placeholder="Search...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            <i class="material-icons">dashboard</i>
                            <p class="d-lg-none d-md-block">
                                Stats
                            </p>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">person</i>
                            <p class="d-lg-none d-md-block">
                                Account
                            </p>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                            <a class="dropdown-item" href="#">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->