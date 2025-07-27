@extends('company.layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Company Details</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $company->name }}</h5>
            <p class="card-text"><strong>Industry:</strong> {{ $company->industry }}</p>
            <p class="card-text"><strong>Location:</strong> {{ $company->location }}</p>
        </div>
    </div>
@endsection
