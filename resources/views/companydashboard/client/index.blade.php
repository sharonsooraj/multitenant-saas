@extends('companydashboard.layouts.app')

@section('content')
    <div class="container mt-4" style="margin-left: 282px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Clients</h4>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Create Client
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="clients-table" class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>

                                <th>Company</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $index => $client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone }}</td>

                                    <td>{{ $client->company->name ?? '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning edit-client-btn" data-id="{{ $client->id }}"
                                            data-name="{{ $client->name }}" data-email="{{ $client->email }}"
                                            data-phone="{{ $client->phone }}"
                                            data-designation="{{ $client->designation }}" data-bs-toggle="modal"
                                            data-bs-target="#editClientModal">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>

                                        <button class="btn btn-sm btn-outline-danger delete-client-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteClientModal"
                                            data-id="{{ $client->id }}" data-name="{{ $client->name }}">
                                            🗑 Delete
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No clients found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" id="editClientForm">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Edit Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-client-id">
                        <div class="mb-3">
                            <label for="edit-client-name" class="form-label">Name</label>
                            <input type="text" name="name" id="edit-client-name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-client-email" class="form-label">Email</label>
                            <input type="email" name="email" id="edit-client-email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-client-phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="edit-client-phone" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Client Modal -->
    <div class="modal fade" id="deleteClientModal" tabindex="-1" aria-labelledby="deleteClientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteClientForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong id="clientNameToDelete"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none'; // 👈 Add this

            $('#clients-table').DataTable({
                language: {
                    emptyTable: "No companies available yet."
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-client-btn');
            const deleteForm = document.getElementById('deleteClientForm');
            const clientNameToDelete = document.getElementById('clientNameToDelete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const clientId = this.getAttribute('data-id');
                    const clientName = this.getAttribute('data-name');
                    clientNameToDelete.textContent = clientName;
                    deleteForm.action = `/admin/clients/${clientId}`;
                });
            });
        });

        $(document).ready(function() {

            // Handle edit
            $(document).on('click', '.edit-client-btn', function() {
                let btn = $(this);
                $('#edit-client-id').val(btn.data('id'));
                $('#edit-client-name').val(btn.data('name'));
                $('#edit-client-email').val(btn.data('email'));
                $('#edit-client-phone').val(btn.data('phone'));
                $('#edit-client-designation').val(btn.data('designation'));
                $('#editClientForm').attr('action', `/admin/clients/${btn.data('id')}`);
            });

            // Handle form submit
            $('#editClientForm').on('submit', function(e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let method = form.attr('method');
                let data = form.serialize();

                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    success: function() {
                        $('#editClientModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Client updated successfully',
                            confirmButtonColor: '#0d6efd',
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
