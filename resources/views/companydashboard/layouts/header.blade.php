<!-- NAV HEADER -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #6610f2);
    }

    .search-area input:focus {
        box-shadow: none;
        outline: none;
    }

    .dropdown-item:hover {
        background-color: #f1f1f1;
    }

    .dropdown-menu {
        transition: all 0.3s ease-in-out;
    }
</style>

<div class="nav-header bg-gradient-primary text-white shadow-sm" style="
width: 238px;
">
    <div class="p-3 d-flex justify-content-between align-items-center">
        <a href="" class="brand-logo text-white fs-4 fw-bold text-decoration-none">
            <i class="bi bi-building me-2"></i>
            @if ($selectedCompany)
                <h4>{{ $selectedCompany->name }}</h4>
            @endif
        </a>
    </div>
</div>

<!-- PAGE HEADER -->
<div class="header bg-white shadow-sm border-bottom">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="container-fluid justify-content-between">

                <!-- Left: Page Title -->
                <div class="header-left d-flex align-items-center">
                    <div class="dashboard_bar fs-5 fw-semibold text-primary">
                        <i class="bi bi-speedometer2 me-2"></i>
                        {{ ucfirst(request()->segment(2) ?? 'Dashboard') }}
                    </div>
                </div>

                <!-- Right: Search and Profile -->
                <div class="header-right d-flex align-items-center gap-3">

                    <!-- Search -->
                    <div class="input-group search-area border rounded-pill overflow-hidden shadow-sm"
                        style="max-width: 250px;">
                        <input type="text" class="form-control border-0 ps-3" placeholder="Search...">
                        <span class="input-group-text bg-transparent border-0">
                            <i class="bi bi-search text-primary"></i>
                        </span>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="dropdown header-profile2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#"
                            role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('admin/images/user.jpg') }}" alt="User Avatar"
                                class="rounded-circle shadow-sm" width="40" height="40">
                            <div class="d-none d-md-block text-start">
                                <h6 class="mb-0 fw-semibold">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">Admin</small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person-circle me-2 text-primary"></i> Profile
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center text-warning"
                                    href="{{ route('admin.companies.index') }}">
                                    <i class="bi bi-x-circle me-2"></i> Deactivate
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </nav>
    </div>
</div>
