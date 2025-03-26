<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
    <div class="container">
        @if (Auth::guard('admin')->check())
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
        @elseif (Auth::guard('employee')->check())
            <a class="navbar-brand fw-bold" href="{{ route('employee.dashboard') }}">Employee Dashboard</a>
        @elseif (Auth::guard('web')->check())
            <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">User Dashboard</a>
        @else
            <a class="navbar-brand fw-bold" href="#">Welcome</a>
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold text-dark" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        @if (Auth::guard('admin')->check())
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">🛠 Admin Dashboard</a></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">🚪 Logout</button>
                                </form>
                            </li>
                        @endif

                        @if (Auth::guard('employee')->check())
                            <li><a class="dropdown-item" href="{{ route('employee.dashboard') }}">📋 Employee Dashboard</a></li>

                            <li>
                                <form method="POST" action="{{ route('employee.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">🚪 Logout</button>
                                </form>
                            </li>
                        @endif

                        @if (Auth::guard('web')->check())
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">🏠 User Dashboard</a></li>
                      
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">🚪 Logout</button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
