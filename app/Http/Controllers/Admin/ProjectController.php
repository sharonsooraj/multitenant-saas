<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest; // Assuming you have a request class for validation
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyId = session('selected_company_id');
        $projects = Project::where('company_id', $companyId)->with('client')->latest()->get();
        return view('companydashboard.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $clients = Client::where('company_id', session('selected_company_id'))->get();
        return view('companydashboard.projects.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $data['company_id'] = session('selected_company_id');
        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
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

    public function getProjectsByClient($clientId)
    {
        $projects = Project::where('client_id', $clientId)->select('id', 'title')->get();

        // Log::info('Projects loaded for client ID: ' . $clientId, ['projects' => $projects]);

        return response()->json($projects);
    }
}
