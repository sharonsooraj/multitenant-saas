@extends('company.layouts.master')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Company</h2>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
    </div>

    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Company Name</label>
            <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
        </div>

        <div class="mb-3">
            <label for="industry" class="form-label">Industry</label>
            <input type="text" name="industry" class="form-control" value="{{ $company->industry }}">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ $company->location }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Company</button>
    </form>
@endsection
