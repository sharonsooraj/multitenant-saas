@extends('companydashboard.layouts.app')

@section('content')
    <div class="container mt-4" style="margin-left: 282px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Employees</h4>
            <a href="{{ route('admin.employees.create') }}" class="btn btn-success">
                <i class="bi bi-plus-lg me-1"></i> Create Employee
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="employees-table" class="table table-hover align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Designation</th>
                                <th>Company</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $index => $employee)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->designation }}</td>
                                    <td>{{ $employee->company->name ?? '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-btn" data-id="{{ $employee->id }}"
                                            data-name="{{ $employee->name }}" data-email="{{ $employee->email }}"
                                            data-phone="{{ $employee->phone }}"
                                            data-designation="{{ $employee->designation }}" data-bs-toggle="modal"
                                            data-bs-target="#editEmployeeModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button class="btn btn-sm btn-outline-danger delete-employee-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal"
                                            data-id="{{ $employee->id }}" data-name="{{ $employee->name }}">
                                            🗑 Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No employees found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editEmployeeForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="edit-phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-designation" class="form-label">Designation</label>
                            <input type="text" name="designation" id="edit-designation" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" aria-labelledby="deleteEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteEmployeeForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong id="EmployeeNameToDelete"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none'; // 👈 Add this

            $('#employees-table').DataTable({
                language: {
                    emptyTable: "No companies available yet."
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-employee-btn');
            const deleteForm = document.getElementById('deleteEmployeeForm');
            const employeeNameToDelete = document.getElementById('EmployeeNameToDelete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const employeeId = this.getAttribute('data-id');
                    const employeeName = this.getAttribute('data-name');
                    employeeNameToDelete.textContent = employeeName;
                    deleteForm.action = `/admin/employees/${employeeId}`;
                });
            });
        });
    </script>


    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#employees-table').DataTable({
                language: {
                    emptyTable: "No employees available"
                }
            });

            // Handle edit button click
            $(document).on('click', '.edit-btn', function() {
                let btn = $(this);
                let id = btn.data('id');
                let name = btn.data('name');
                let email = btn.data('email');
                let phone = btn.data('phone');
                let designation = btn.data('designation');

                $('#edit-id').val(id);
                $('#edit-name').val(name);
                $('#edit-email').val(email);
                $('#edit-phone').val(phone);
                $('#edit-designation').val(designation);

                // Set dynamic action for form
                $('#editEmployeeForm').attr('action', '/admin/employees/' + id);
            });

            // SweetAlert for success messages
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#198754',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            @endif

            // Handle form submission
            $('#editEmployeeForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                let data = form.serialize();

                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    success: function(response) {
                        $('#editEmployeeModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Employee updated successfully',
                            confirmButtonColor: '#198754',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        for (let field in errors) {
                            errorMessages += errors[field][0] + '\n';
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: errorMessages,
                            confirmButtonColor: '#dc3545'
                        });
                    }
                });
            });
        });
    </script>
@endsection
