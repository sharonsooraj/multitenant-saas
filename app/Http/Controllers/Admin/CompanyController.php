<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest; // Assuming you have a request class for validation
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Employee;
use App\Models\Client;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $companies = Company::where('user_id', auth()->id())->latest()->get();

        return view('dashboard', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        Company::create($data);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company created successfully.');
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
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->only(['name', 'industry', 'email', 'phone', 'address', 'status']));

        return redirect()->back()->with('success', 'Company updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $company = Company::where('user_id', auth()->id())->findOrFail($id);
        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Company deleted successfully.');
    }

    public function dashboard(Company $company)
{
    // Switch the selected company in session
    session()->forget('selected_company_id');
    session(['selected_company_id' => $company->id]);

    // Load company owner (user)
    $company->load('user');

    // Get counts directly related to the selected company
    $totalEmployees = $company->employees()->count();
    $totalClients = $company->clients()->count();
    $totalProjects = $company->projects()->count();

    // Example chart data (you can replace with real data)
    $chartData = [
        'labels' => ['Jan', 'Feb', 'Mar'],
        'values' => [10, 20, 30]
    ];

    return view('companydashboard.dashboard', compact('company', 'totalEmployees', 'totalClients', 'totalProjects', 'chartData'));
}

}
