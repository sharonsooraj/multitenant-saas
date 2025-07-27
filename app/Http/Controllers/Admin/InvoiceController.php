<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Company;
use App\Models\Client;
use App\Models\Project;
use App\Http\Requests\StoreInvoiceRequest; // Assuming you have a request class for validation
use Illuminate\Support\Facades\Auth;


class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        // Get the selected company ID from session (set during login or company switch)
        $companyId = session('selected_company_id');

        // Fetch invoices belonging to this company, with related customer/project (if any)
        $invoices = Invoice::with(['client', 'project']) // Adjust relations based on your model
            ->where('company_id', $companyId)
            ->latest()
            ->get();

        // Load company relation with user if needed
        $company->load('user');

        return view('companydashboard.invoice.index', compact('invoices', 'company'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastInvoice = Invoice::latest('id')->first();
        $nextInvoiceNumber = $lastInvoice ? 'INV-' . str_pad($lastInvoice->id + 1, 5, '0', STR_PAD_LEFT) : 'INV-00001';
        $clients = Client::all(); // or filtered by logged-in user's company if needed
        return view('companydashboard.invoice.create', compact('clients', 'nextInvoiceNumber'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();

        // Extract line items and remove them from main invoice data
        $items = $validated['items'];
        unset($validated['items']);

        // Generate next unique invoice number
        $latestInvoice = Invoice::orderBy('id', 'desc')->first();
        $nextNumber = $latestInvoice ? intval(substr($latestInvoice->invoice_number, 4)) + 1 : 1;
        $invoiceNumber = 'INV-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        // Add invoice number to validated data
        $validated['invoice_number'] = $invoiceNumber;

        // Create the invoice
        $invoice = Invoice::create($validated);

        // Create invoice items
        foreach ($items as $item) {
            $invoice->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'rate' => $item['rate'],
                'amount' => $item['amount'],
            ]);
        }

        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
