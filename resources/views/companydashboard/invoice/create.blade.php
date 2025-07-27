@extends('companydashboard.layouts.app')

@section('content')
    <div class="container mt-5" style="margin-left: 282px;">
        <h2>Create Invoice</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.invoices.store') }}" method="POST" id="invoice-form">
            @csrf
            <input type="hidden" name="company_id" value="{{ session('selected_company_id') }}">
            <div class="mb-3">
                <label for="invoice_number" class="form-label">Invoice Number</label>
                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                    value="{{ $nextInvoiceNumber }}" readonly>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
                    <select class="form-select" id="client_id" name="client_id" required>
                        <option value="">Select Client</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="project_id" class="form-label">Project <span class="text-danger">*</span></label>
                    <select class="form-select" id="project_id" name="project_id" required>
                        <option value="">Select Project</option>
                        @if (old('client_id'))
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}"
                                    {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->title }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="issue_date" class="form-label">Issue Date <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" id="issue_date" name="issue_date"
                        value="{{ old('issue_date', date('Y-m-d')) }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="due_date" class="form-label">Due Date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date"
                        value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}">
                </div>
            </div>

            <hr>

            <h5>Invoice Items <span class="text-danger">*</span></h5>
            <table class="table table-bordered" id="items-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Rate (₹)</th>
                        <th>Amount (₹)</th>
                        <th><button type="button" class="btn btn-sm btn-primary" id="add-item">+</button></th>
                    </tr>
                </thead>
                <tbody>
                    @if (old('items'))
                        @foreach (old('items') as $index => $item)
                            <tr>
                                <td>
                                    <input type="text" name="items[{{ $index }}][description]"
                                        class="form-control" value="{{ $item['description'] }}" required>
                                </td>
                                <td>
                                    <input type="number" name="items[{{ $index }}][quantity]"
                                        class="form-control qty" min="1" value="{{ $item['quantity'] }}" required>
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="items[{{ $index }}][rate]"
                                        class="form-control rate" value="{{ $item['rate'] }}" required>
                                </td>
                                <td>
                                    <input type="text" name="items[{{ $index }}][amount]"
                                        class="form-control amount" value="{{ $item['amount'] }}" readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger remove-item">-</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <input type="text" name="items[0][description]" class="form-control" required>
                            </td>
                            <td>
                                <input type="number" name="items[0][quantity]" class="form-control qty" min="1"
                                    value="1" required>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="items[0][rate]" class="form-control rate"
                                    required>
                            </td>
                            <td>
                                <input type="text" name="items[0][amount]" class="form-control amount" readonly>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove-item">-</button>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <hr>

            <h5>GST Summary</h5>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Subtotal (₹)</label>
                    <input type="text" id="subtotal" name="subtotal" class="form-control"
                        value="{{ old('subtotal', '0.00') }}" readonly>
                </div>
                <div class="col-md-4">
                    <label>GST (18%) (₹)</label>
                    <input type="text" id="gst" name="gst_amount" class="form-control"
                        value="{{ old('gst_amount', '0.00') }}" readonly>
                </div>
                <div class="col-md-4">
                    <label>Total (₹)</label>
                    <input type="text" id="total" name="grand_total" class="form-control"
                        value="{{ old('grand_total', '0.00') }}" readonly>
                </div>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes</label>
                <textarea class="form-control" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Create Invoice</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            let itemIndex = {{ old('items') ? count(old('items')) : 1 }};

            // Load projects based on selected client
            $('#client_id').on('change', function() {
                let clientId = $(this).val();
                $('#project_id').html('<option value="">Loading...</option>');

                if (clientId) {
                    $.ajax({
                        url: `/admin/company/clients/${clientId}/projects`,
                        method: 'GET',
                        success: function(data) {
                            let options = '<option value="">Select Project</option>';
                            data.forEach(project => {
                                options +=
                                    `<option value="${project.id}">${project.title}</option>`;
                            });
                            $('#project_id').html(options);

                            // Select previously selected project if any
                            @if (old('project_id'))
                                $('#project_id').val('{{ old('project_id') }}');
                            @endif
                        },
                        error: function() {
                            $('#project_id').html(
                                '<option value="">Error loading projects</option>');
                        }
                    });
                } else {
                    $('#project_id').html('<option value="">Select Project</option>');
                }
            });

            // Trigger change if client is already selected (form validation failed)
            @if (old('client_id'))
                $('#client_id').val('{{ old('client_id') }}').trigger('change');
            @endif

            // Add invoice item row
            $('#add-item').on('click', function() {
                const newRow = `
                <tr>
                    <td><input type="text" name="items[${itemIndex}][description]" class="form-control" required></td>
                    <td><input type="number" name="items[${itemIndex}][quantity]" class="form-control qty" min="1" value="1" required></td>
                    <td><input type="number" step="0.01" name="items[${itemIndex}][rate]" class="form-control rate" required></td>
                    <td><input type="text" name="items[${itemIndex}][amount]" class="form-control amount" readonly></td>
                    <td><button type="button" class="btn btn-sm btn-danger remove-item">-</button></td>
                </tr>`;
                $('#items-table tbody').append(newRow);
                itemIndex++;
            });

            // Remove item row
            $(document).on('click', '.remove-item', function() {
                if ($('#items-table tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                    calculateTotals();
                } else {
                    alert('At least one item is required');
                }
            });

            // Calculate row amount and totals
            $(document).on('input', '.qty, .rate', function() {
                const row = $(this).closest('tr');
                const qty = parseFloat(row.find('.qty').val()) || 0;
                const rate = parseFloat(row.find('.rate').val()) || 0;
                const amount = qty * rate;
                row.find('.amount').val(amount.toFixed(2));
                calculateTotals();
            });

            function calculateTotals() {
                let subtotal = 0;
                $('.amount').each(function() {
                    subtotal += parseFloat($(this).val()) || 0;
                });

                const gstRate = 18; // You can make this configurable if needed
                const gstAmount = subtotal * (gstRate / 100);
                const total = subtotal + gstAmount;

                $('#subtotal').val(subtotal.toFixed(2));
                $('#gst').val(gstAmount.toFixed(2));
                $('#total').val(total.toFixed(2));
            }

            // Initial calculation if there are old values
            @if (old('items'))
                calculateTotals();
            @else
                // Trigger calculation for the first row
                $('#items-table tbody tr:first .rate').trigger('input');
            @endif
        });
    </script>
@endsection
