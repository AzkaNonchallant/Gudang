<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #7209b7;
            --accent-color: #4cc9f0;
            --text-light: #f8f9fa;
            --text-dark: #212529;
            --bg-dark: #1a1d24;
            --bg-darker: #15181e;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        /* Enhanced Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, var(--bg-dark), var(--bg-darker)) !important;
            box-shadow: var(--shadow);
            padding: 0.8rem 0;
            border-bottom: 3px solid var(--primary-color);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            padding: 0.2rem 0.5rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            transform: translateY(-2px);
            text-shadow: 0 4px 8px rgba(67, 97, 238, 0.3);
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-light) !important;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 6px;
            transition: var(--transition);
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link i {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .nav-link:hover {
            background-color: rgba(67, 97, 238, 0.15);
            color: var(--accent-color) !important;
            transform: translateY(-1px);
        }

        .nav-link:hover i {
            opacity: 1;
            transform: scale(1.1);
        }

        .nav-link.active {
            background-color: var(--primary-color);
            color: white !important;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid var(--primary-color);
        }

        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.4rem 0.6rem;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.5);
        }

        .user-greeting {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 600;
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--text-light) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logout-btn:hover {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545 !important;
            transform: translateY(-1px);
        }

        .admin-badge {
            background: linear-gradient(45deg, var(--secondary-color), #b5179e);
            color: white;
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            margin-left: 0.5rem;
            font-weight: 600;
        }

        .nav-divider {
            width: 1px;
            height: 24px;
            background: rgba(255, 255, 255, 0.2);
            margin: 0 1rem;
        }

        /* Mobile responsiveness */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: var(--bg-darker);
                padding: 1rem;
                border-radius: 8px;
                margin-top: 1rem;
                box-shadow: var(--shadow);
            }

            .nav-divider {
                display: none;
            }

            .nav-link {
                margin: 0.2rem 0;
                padding: 0.75rem 1rem !important;
            }

            .logout-btn {
                width: 100%;
                justify-content: center;
                margin: 0.2rem 0;
            }
        }

        /* Main content area */
        main.container {
            margin-top: 2rem;
            min-height: calc(100vh - 200px);
        }

        /* Footer style (optional) */
        footer {
            background: var(--bg-dark);
            color: var(--text-light);
            padding: 2rem 0;
            margin-top: 4rem;
            border-top: 3px solid var(--primary-color);
        }
    </style>
</head>
<body>
    {{-- ✅ Enhanced Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            {{-- Brand with icon --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-cube me-2"></i>Gudang
            </a>

            {{-- Mobile toggle button --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Navbar content --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- Left side navigation --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" 
                           href="{{ route('dashboard') }}">
                            <i class="fas fa-chart-line"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('barangs.*') ? 'active' : '' }}" 
                           href="{{ route('barangs.index') }}">
                            <i class="fas fa-boxes"></i>Barang
                        </a>
                    </li>

                    {{-- Admin menu --}}
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                                   href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users-cog"></i>Manajemen User
                                    <span class="admin-badge">ADMIN</span>
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>

                {{-- Right side auth section --}}
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        {{-- Guest links --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>Register
                            </a>
                        </li>
                    @else
                        {{-- User greeting --}}
                        <li class="nav-item">
                            <span class="nav-link user-greeting">
                                <i class="fas fa-user-circle"></i>Hi, {{ Auth::user()->name }}
                            </span>
                        </li>

                        {{-- Divider --}}
                        <li class="nav-item d-none d-lg-block">
                            <div class="nav-divider"></div>
                        </li>

                        {{-- Logout form --}}
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="fas fa-sign-out-alt"></i>Logout
                                </button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- Spacer for fixed navbar --}}
    <div style="height: 80px;"></div>

    <main class="container">
        @yield('content')
    </main>

    {{-- Optional Footer --}}
    <footer class="text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} Gudang. All rights reserved.</p>
            <p class="text-muted">Built with Laravel & Bootstrap</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Add smooth scrolling and active link highlighting --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling to all links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Enhance navbar dropdowns on mobile
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.querySelector('.navbar-collapse');
            
            if (navbarToggler && navbarCollapse) {
                navbarToggler.addEventListener('click', function() {
                    navbarCollapse.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>