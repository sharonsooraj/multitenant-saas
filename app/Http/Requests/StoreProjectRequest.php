<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Client;




class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{

    // dd([
    //     'description' => $_REQUEST['description'] ?? null,
    //     'start_date' => $_REQUEST['start_date'] ?? null,
    //     'end_date' => $_REQUEST['end_date'] ?? null,
    // ]);

    return [
        'client_id' => 'required|exists:clients,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        
    ];
}

}
