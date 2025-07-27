<style>
    .deznav {
        width: 240px;
        min-height: 100vh;
        transition: all 0.3s ease-in-out;
        background-color: #fff;
    }

    .menu-item:hover {
        background: #f0f4f8;
        color: #0d6efd !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .menu-item:hover i {
        color: #0d6efd !important;
    }

    .menu-item.active {
        background-color: #eaf3ff;
        font-weight: 600;
        color: #0d6efd !important;
    }

    .menu-item.active i {
        color: #0d6efd !important;
    }

    .deznav-scroll {
        overflow-y: auto;
        height: calc(100vh - 60px);
    }
</style>

<div class="deznav bg-white shadow-sm border-end">
    <div class="deznav-scroll">
        <ul class="metismenu list-unstyled m-0 p-3" id="menu" style="font-size: 15px;">
            <!-- Dashboard -->
            <li class="mb-2">
                <a href="{{ route('company.dashboard', ['company' => session('selected_company_id')]) }}"
                    class="d-flex align-items-center text-decoration-none py-2 px-3 rounded menu-item
                    {{ request()->routeIs('company.dashboard') ? 'bg-success text-white' : 'text-dark' }}">
                    <i
                        class="bi bi-speedometer2 me-3 fs-5 {{ request()->routeIs('company.dashboard') ? 'text-white' : 'text-success' }}"></i>
                    <span>Dashboard</span>
                </a>
            </li>


            <!-- Employees -->
            <li class="mb-2">
                <a href="{{ route('admin.employees.index', ['company' => session('selected_company_id')]) }}) }}"
                    class="d-flex align-items-center text-decoration-none py-2 px-3 rounded menu-item
                    {{ request()->routeIs('admin.employees.*') ? 'bg-success text-white' : 'text-dark' }}">
                    <i
                        class="bi bi-people me-3 fs-5 {{ request()->routeIs('admin.employees.*') ? 'text-white' : 'text-success' }}"></i>
                    <span>Employees</span>
                </a>
            </li>

            <li class="mb-2">
                <a href="{{ route('admin.clients.index', ['company' => session('selected_company_id')]) }}"
                    class="d-flex align-items-center text-decoration-none py-2 px-3 rounded menu-item
                    {{ request()->routeIs('admin.clients.*') ? 'bg-success text-white' : 'text-dark' }}">
                    <i
                        class="bi bi-person-badge me-3 fs-5 {{ request()->routeIs('admin.clients.*') ? 'text-white' : 'text-primary' }}"></i>
                    <span>Clients</span>
                </a>
            </li>
            <!-- Projects -->
            <li class="mb-2">
                <a href="{{ route('admin.projects.index', ['company' => session('selected_company_id')]) }}"
                    class="d-flex align-items-center text-decoration-none py-2 px-3 rounded menu-item
                    {{ request()->routeIs('admin.projects.*') ? 'bg-success text-white' : 'text-dark' }}">
                    <i
                        class="bi bi-kanban me-3 fs-5 {{ request()->routeIs('admin.projects.*') ? 'text-white' : 'text-info' }}"></i>
                    <span>Projects</span>
                </a>
            </li>


            <!-- Invoices -->
            <li class="mb-2">
                <a href="{{ route('admin.invoices.index', ['company' => session('selected_company_id')]) }}"
                    class="d-flex align-items-center text-decoration-none py-2 px-3 rounded menu-item
        {{ request()->routeIs('admin.invoices.*') ? 'bg-success text-white' : 'text-dark' }}">
                    <i
                        class="bi bi-file-earmark-text me-3 fs-5 {{ request()->routeIs('admin.invoices.*') ? 'text-white' : 'text-warning' }}"></i>
                    <span>Invoices</span>
                </a>
            </li>


            <!-- Clients -->

        </ul>
    </div>
</div>
