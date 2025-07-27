@extends('companydashboard.layouts.app')

@section('content')
    <div class="container mt-4" style="margin-left: 282px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Invoices</h4>
            <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Create Invoice
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="invoices-table" class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Invoice No</th>
                                <th>Customer</th>
                                <th>Project Name</th>
                                {{-- <th>Status</th> --}}
                                <th>Issue Date</th>
                                <th>Due Date</th>
                                {{-- <th>Total</th> --}}
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $index => $invoice)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->client->name ?? '-' }}</td>
                                    <td>{{ $invoice->project->title ?? '-' }}</td>
                                    {{-- <td>
                                        <span
                                            class="badge bg-{{ $invoice->status == 'paid' ? 'success' : ($invoice->status == 'unpaid' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td> --}}
                                    <td>{{ $invoice->issue_date }}</td>
                                    <td>{{ $invoice->due_date }}</td>
                                    {{-- <td>₹ {{ number_format($invoice->total, 2) }}</td> --}}
                                    {{-- <td>
                                        <a href="{{ route('admin.invoices.edit', $invoice->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger delete-invoice-btn"
                                            data-bs-toggle="modal" data-bs-target="#deleteInvoiceModal"
                                            data-id="{{ $invoice->id }}" data-invoice="{{ $invoice->invoice_no }}">
                                            🗑 Delete
                                        </button>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No invoices found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Invoice Modal -->
    <div class="modal fade" id="deleteInvoiceModal" tabindex="-1" aria-labelledby="deleteInvoiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteInvoiceForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Invoice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete Invoice <strong id="invoiceNumberToDelete"></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- DataTable & Delete Modal Script -->
    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.errMode = 'none';

            $('#invoices-table').DataTable({
                language: {
                    emptyTable: "No invoices available yet."
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-invoice-btn');
            const deleteForm = document.getElementById('deleteInvoiceForm');
            const invoiceNumberToDelete = document.getElementById('invoiceNumberToDelete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const invoiceId = this.getAttribute('data-id');
                    const invoiceNo = this.getAttribute('data-invoice');
                    invoiceNumberToDelete.textContent = invoiceNo;
                    deleteForm.action = `/admin/invoices/${invoiceId}`;
                });
            });
        });
    </script>
@endsection
