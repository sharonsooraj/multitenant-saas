<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCompanyRequest; // Assuming you have a request class for validation

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->companies;
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = $request->user()->companies()->create($request->validated());
        return response()->json(['message' => 'Company created', 'company' => $company], 201);
    }

    public function show(Company $company)
    {
        return $company;

    }

    public function update(StoreCompanyRequest $request, Company $company)
    {
        $this->authorizeCompany($request, $company);
        $company->update($request->validated());
        return response()->json(['message' => 'Company updated', 'company' => $company]);
    }

    public function destroy(Request $request, Company $company)
    {
        $this->authorizeCompany($request, $company);
        $company->delete();
        return response()->json(['message' => 'Company deleted']);
    }

    public function setActive(Request $request, Company $company)
    {
        $this->authorizeCompany($request, $company);
        $request->user()->update(['active_company_id' => $company->id]);
        return response()->json(['message' => 'Active company set']);
    }

    protected function authorizeCompany(Request $request, Company $company)
    {
        if ($company->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }
    }
}

