<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Lumica Production</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        /* Desain Sidebar */
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #212529; 
            color: #fff;
            transition: all 0.3s;
            display: flex;
            flex-direction: column; 
            position: fixed; 
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }
        #sidebar .sidebar-header {
            background: #1a1e21;
        }
        #sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-left: 4px solid transparent;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            color: #fff;
            background: #343a40;
            border-left: 4px solid #ffc107; 
            text-decoration: none;
        }
        #sidebar .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }
        
        /* Area Konten Utama */
        #content {
            width: 100%;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
    </style>
</head>
<body>

    <nav id="sidebar">
        <div class="sidebar-header p-4 border-bottom border-secondary">
            <h4 class="fw-bold mb-0 text-white">
                <i class="bi bi-camera-fill text-warning me-2"></i>LUMICA
            </h4>
            <small class="text-white-50">Admin Panel</small>
        </div>

        <ul class="list-unstyled components mt-2 flex-grow-1">
            
            <li>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span><i class="bi bi-speedometer2"></i> Dashboard</span>
                </a>
            </li>
            
            <li class="px-3 pt-4 pb-2 text-uppercase small text-white-50 fw-bold">Manajemen Bisnis</li>
            
            <li>
                <a href="{{ route('portfolios.index') }}" class="nav-link {{ request()->routeIs('portfolios.*') ? 'active' : '' }}">
                    <span><i class="bi bi-images"></i> Portofolio</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <span><i class="bi bi-tags"></i> Paket Foto (Tiket)</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <span><i class="bi bi-cart-check"></i> Pesanan Masuk</span>
                    
                    @php
                        // Hitung Order Pending untuk Badge Merah
                        $pendingCount = \App\Models\Order::where('status', 'pending')->count();
                    @endphp
                    
                    @if($pendingCount > 0)
                        <span class="badge bg-danger rounded-pill">{{ $pendingCount }}</span>
                    @endif
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.tracking') }}" class="nav-link {{ request()->routeIs('admin.tracking') ? 'active' : '' }}">
                    <span><i class="bi bi-search"></i> Tracking Order</span>
                </a>
            </li>
                        <li>
                <a href="{{ route('payments.index') }}" class="nav-link {{ request()->routeIs('payments.*') ? 'active' : '' }}">
                    <span><i class="bi bi-credit-card"></i> Metode Bayar</span>
                </a>
            </li>

            <li class="px-3 pt-4 pb-2 text-uppercase small text-white-50 fw-bold">Pengguna</li>

            <li>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span><i class="bi bi-person-lines-fill"></i> Kelola User</span>
                </a>
            </li>

            
            <li class="px-3 pt-4 pb-2 text-uppercase small text-white-50 fw-bold">Halaman Web</li>
            
            <li>
                <a href="{{ route('teams.index') }}" class="nav-link {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                    <span><i class="bi bi-people"></i> About Team</span>
                </a>
            </li>
            
            <li>
                <a href="{{ route('credits.index') }}" class="nav-link {{ request()->routeIs('credits.*') ? 'active' : '' }}">
                    <span><i class="bi bi-code-slash"></i> Credit</span>
                </a>
            </li>
        </ul>

        <div class="p-3 border-top border-secondary bg-dark mt-auto">
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-gear-fill"></i> Edit Profil & Password
            </a>
        </div>
    </nav>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-3">
            <div class="container-fluid">
                <div class="d-flex align-items-center ms-auto">
                    <div class="me-3 text-end d-none d-md-block">
                        <small class="text-muted d-block">Selamat Datang,</small>
                        <span class="fw-bold text-dark">{{ Auth::user()->name ?? 'Administrator' }}</span>
                    </div>
                    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm px-3 rounded-pill shadow-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="p-4 flex-grow-1">
            @yield('content')
        </div>

        <footer class="bg-white text-center py-3 border-top mt-auto">
            <small class="text-muted">&copy; {{ date('Y') }} Lumica Production Admin Panel. All Rights Reserved.</small>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>