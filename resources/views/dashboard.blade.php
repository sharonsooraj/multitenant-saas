<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Companies</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/frontend/images/logo-light.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .badge {
            font-size: 0.85rem;
        }

        .dataTables_empty {
            text-align: center;
            font-style: italic;
            color: #888;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-light shadow-sm">
        <div class="container-fluid">
            <div class="uc-logo flex items-center gap-3 text-dark">
                <span class="text-2xl fw-bold tracking-wide text-dark">Printfuse</span>
                <img src="{{ asset('assets/frontend/images/logo-light.png') }}" alt="CloudSpace" style="width: 110px;">
            </div>

            <div class="d-flex align-items-center">
                <span class="text-dark me-3 fw-semibold">👋 Hi, {{ Auth::user()->name }}</span>
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Profile
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a></li>
                        <li>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-primary">📋 Companies List</h4>
                <a href="{{ route('admin.companies.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Create Company
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle" id="companies-table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Company Name</th>
                                <th>Industry</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Company Status</th>
                                <th>Actions</th>
                                <th>Set Active</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $index => $company)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->industry }}</td>

                                    <td>{{ $company->email }}</td>
                                    <td>{{ $company->phone }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $company->status === 'active' ? 'success' : 'secondary' }}">
                                            {{ $company->status === 'active' ? 'Active' : 'Inactive' }}
                                        </span>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary edit-company-btn"
                                            data-bs-toggle="modal" data-bs-target="#editCompanyModal"
                                            data-id="{{ $company->id }}" data-name="{{ $company->name }}"
                                            data-industry="{{ $company->industry }}"
                                            data-email="{{ $company->email }}" data-phone="{{ $company->phone }}"
                                            data-address="{{ $company->address }}"
                                            data-status="{{ $company->status }}">
                                            ✏️ Edit
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger delete-company-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteCompanyModal"
                                            data-id="{{ $company->id }}" data-name="{{ $company->name }}">
                                            🗑 Delete
                                        </button>

                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-success activate-company-btn"
                                            data-bs-toggle="modal" data-bs-target="#activateCompanyModal"
                                            data-id="{{ $company->id }}" data-name="{{ $company->name }}"
                                            data-status="{{ $company->status }}">
                                            🚀 Activate
                                        </button>
                                    </td>




                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No companies added yet.</td>
                                    <!-- ✅ Fixed: colspan="8" -->
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-4 shadow-sm mt-auto">
        <div class="container">
            <small class="text-muted">© {{ date('Y') }} Printfuse. All rights reserved.</small>
        </div>
    </footer>


    <!-- Activate Company Modal -->
    <div class="modal fade" id="activateCompanyModal" tabindex="-1" aria-labelledby="activateCompanyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Activate Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="activateCompanyModalBody">
                    <!-- Filled dynamically by JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Company Modal -->
    <div class="modal fade" id="deleteCompanyModal" tabindex="-1" aria-labelledby="deleteCompanyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteCompanyForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Company</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong id="companyNameToDelete"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Company Modal -->
    <div class="modal fade" id="editCompanyModal" tabindex="-1" aria-labelledby="editCompanyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="editCompanyForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Company</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="id" id="editCompanyId">

                        <div class="mb-3">
                            <label for="editCompanyName" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="name" id="editCompanyName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editIndustry" class="form-label">Industry</label>
                            <input type="text" class="form-control" name="industry" id="editIndustry" required>
                        </div>

                        <div class="mb-3">
                            <label for="editCompanyEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="editCompanyEmail">
                        </div>

                        <div class="mb-3">
                            <label for="editCompanyPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="editCompanyPhone">
                        </div>

                        <div class="mb-3">
                            <label for="editCompanyAddress" class="form-label">Address</label>
                            <textarea class="form-control" name="address" id="editCompanyAddress"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="editCompanyStatus" class="form-label">Status</label>
                            <select class="form-select" name="status" id="editCompanyStatus">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Company</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <!-- JS Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none'; // 👈 Add this

            $('#companies-table').DataTable({
                language: {
                    emptyTable: "No companies available yet."
                }
            });
        });


        // Handle sweet alert after success
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#198754'
            });
        @endif

        @if (session('company_activated'))
            Swal.fire({
                icon: 'success',
                title: 'Activated!',
                text: '{{ session('company_activated') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        // Modal setup
        // const activateCompanyModal = document.getElementById('activateCompanyModal');
        // activateCompanyModal.addEventListener('show.bs.modal', function(event) {
        //     const button = event.relatedTarget;
        //     const companyId = button.getAttribute('data-id');
        //     const companyName = button.getAttribute('data-name');

        //     document.getElementById('companyName').textContent = companyName;
        //     const form = document.getElementById('activateCompanyForm');
        //     form.action = `/company/dashboard/${companyId}`;
        // });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const activateButtons = document.querySelectorAll('.activate-company-btn');
            const modalBody = document.getElementById('activateCompanyModalBody');

            activateButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const companyName = button.getAttribute('data-name');
                    const companyId = button.getAttribute('data-id');
                    const status = button.getAttribute('data-status');

                    if (status == 'inactive') {
                        // Already inactive, show error
                        modalBody.innerHTML = `
                        <div class="alert alert-danger">
                            <strong>Error:</strong> Company <b>${companyName}</b> is already inactive and cannot be activated.
                        </div>
                    `;
                    } else {
                        // Show activation confirmation form
                        modalBody.innerHTML = `
                        <p>Are you sure you want to activate <strong>${companyName}</strong>?</p>
                        <form method="GET" action="/company/dashboard/${companyId}">
                            @csrf
                            <button type="submit" class="btn btn-success">Yes, Activate</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    `;
                    }
                });
            });
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-company-btn');
            const deleteForm = document.getElementById('deleteCompanyForm');
            const companyNameToDelete = document.getElementById('companyNameToDelete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const companyId = this.getAttribute('data-id');
                    const companyName = this.getAttribute('data-name');
                    companyNameToDelete.textContent = companyName;
                    deleteForm.action = `/admin/companies/${companyId}`;
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-company-btn');
            const editForm = document.getElementById('editCompanyForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const industry = this.getAttribute('data-industry');

                    const email = this.getAttribute('data-email');
                    const phone = this.getAttribute('data-phone');
                    const address = this.getAttribute('data-address');
                    const status = this.getAttribute('data-status');

                    document.getElementById('editCompanyId').value = id;
                    document.getElementById('editCompanyName').value = name;
                    document.getElementById('editIndustry').value = industry;

                    document.getElementById('editCompanyEmail').value = email;
                    document.getElementById('editCompanyPhone').value = phone;
                    document.getElementById('editCompanyAddress').value = address;
                    document.getElementById('editCompanyStatus').value = status;

                    editForm.action = `/admin/companies/${id}`;
                });
            });
        });
        console.log(
            "%cSHARON SOORAJ",
            "font-size: 80px; font-weight: bold; color: #4CAF50; text-shadow: 2px 2px #000;"
        );
    </script>


</body>

</html>
