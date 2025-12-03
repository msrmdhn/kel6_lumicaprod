<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-camera-fill me-2"></i>LUMICA PRODUCTION
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.portfolio') ? 'active' : '' }}" href="{{ route('public.portfolio') }}">
                        Portofolio
                    </a>
                </li>

                @if(Route::has('orders.create'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('orders.create') ? 'active' : '' }}" href="{{ route('orders.create') }}">
                        Order Jasa
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.team') ? 'active' : '' }}" href="{{ route('public.team') }}">
                        About Team
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('public.credit') ? 'active' : '' }}" href="{{ route('public.credit') }}">
                        Credit
                    </a>
                </li>

                @guest
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-outline-light btn-sm px-3" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                        <a class="btn btn-warning btn-sm px-3 fw-bold" href="{{ route('register') }}">Daftar</a>
                    </li>
                @else
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle active text-warning fw-bold" href="#" role="button" data-bs-toggle="dropdown">
                            Halo, {{ auth()->user()->username ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            
                            @if(auth()->user()->role == 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard Admin
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-clock-history me-2"></i> Riwayat Pesanan
                                    </a>
                                </li>
                            @endif
                            
                            <li><hr class="dropdown-divider"></li>
                            
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>