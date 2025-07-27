@extends('companydashboard.layouts.app')

@section('content')
    <div class="content-body">
        <div class="container-fluid" style="
    margin-left: 16px;
">
            <div class="row mb-4">
                <div class="col">
                    <h4 class="mb-0">🏢 Company Dashboard</h4>
                </div>
            </div>

            <div class="row g-4">
                <!-- Employees -->
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-primary text-white rounded-circle p-3">
                                    <i class="fas fa-users fa-lg"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Employees</h6>
                                <h4 class="mb-0">{{ $totalEmployees ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Projects -->
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-success text-white rounded-circle p-3">
                                    <i class="fas fa-tasks fa-lg"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Projects</h6>
                                <h4 class="mb-0">{{ $totalProjects ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Clients -->
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-warning text-white rounded-circle p-3">
                                    <i class="fas fa-handshake fa-lg"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Clients</h6>
                                <h4 class="mb-0">{{ $totalClients ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Optional: Revenue / Tasks / Teams -->
                <div class="col-md-6 col-xl-3">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="bg-info text-white rounded-circle p-3">
                                    <i class="fas fa-coins fa-lg"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1">Revenue</h6>
                                <h4 class="mb-0">₹{{ number_format($totalRevenue ?? 0) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Add more rows/cards if needed --}}

        </div>
    </div>
@endsection
