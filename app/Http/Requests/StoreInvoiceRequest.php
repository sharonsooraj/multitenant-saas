<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize()
    {
        return true; // allow all users to submit
    }

    public function rules()
    {
        return [
            'company_id'      => 'required|exists:companies,id',
            'invoice_number' => 'required|string|max:255',
            'client_id'        => 'required',
            'project_id'       => 'required',
            'issue_date'       => 'required|date',
            'due_date'         => 'nullable|date|after_or_equal:issue_date',

            'items'                 => 'required|array|min:1',
            'items.*.description'   => 'required|string|max:255',
            'items.*.quantity'      => 'required|integer|min:1',
            'items.*.rate'          => 'required|numeric|min:0',
            'items.*.amount'        => 'required|numeric|min:0',

            'subtotal'        => 'required|numeric|min:0',
            'gst_amount'      => 'required|numeric|min:0',
            'grand_total'     => 'required|numeric|min:0',
            'notes'           => 'nullable|string|max:1000',
        ];
    }
}
