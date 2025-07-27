<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEmployeeRequest; // Assuming you have a request class for validation


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {

        // Only employees belonging to this company
        $employees = Employee::with('company')
            ->where('company_id', session('selected_company_id')) // Ensure this session variable is set during login or middleware
            ->latest()
            ->get();

        // Load the related user of this company
        $company->load('user');

        return view('companydashboard.employee.index', compact('employees', 'company'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return view('companydashboard.employee.create', compact('company'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $companyId = session('selected_company_id'); // ensure this is set during login or middleware

        Employee::create([
            'company_id' => $companyId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'designation' => $request->designation,
            'status' => 'active', // Default status, can be changed later
        ]);

        return redirect()
            ->route('admin.employees.index', $companyId)
            ->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:255',
        ]);

        // Find employee
        $employee = Employee::findOrFail($id);

        // Update employee fields
        $employee->update($validated);

        // Flash message and redirect
        return redirect()->back()->with('success', 'Employee updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // Check if the employee belongs to the current company (optional security)
        if (session()->has('company_id') && $employee->company_id != session('company_id')) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $employee->delete();

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
