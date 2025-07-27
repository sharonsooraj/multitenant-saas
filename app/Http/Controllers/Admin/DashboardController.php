<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\User;
use App\Models\Employee;
use App\Models\Client;
use App\Models\Project;


class DashboardController extends Controller
{

public function index()
{
    $user = Auth::user();

    $companies = $user->companies()->latest()->get();

    // Get active company (assumes there's a method or relationship to fetch it)
    $activeCompany = $user->activeCompany;

    // If no active company, fallback to null counts
    $totalEmployees = $activeCompany ? Employee::where('company_id', $activeCompany->id)->count() : 0;
    $totalClients = $activeCompany ? Client::where('company_id', $activeCompany->id)->count() : 0;
    $totalProjects = $activeCompany ? Project::where('company_id', $activeCompany->id)->count() : 0;

    return view('dashboard', compact('companies', 'totalEmployees', 'totalClients', 'totalProjects'));
}

}
