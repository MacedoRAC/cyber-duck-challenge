@extends('layouts.crm')

@section('card-header-title')
    Adding new Employee
@endsection

@section('card-header-action')
    <a class=" btn btn-secondary" href="{{ route('companies.employees.index', $company) }}">Employees List</a>
@endsection

@section('card-body-content')
    <form method="post" action="{{ route('companies.employees.store', $company->id) }}">
        @csrf

        <div class="form-group">
            <label for="first_name" class="required">First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                   aria-describedby="firstNameHelp" value="{{ old('first_name') }}" required>
            @error('first_name')
            <small id="firstNameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="last_name" class="required">Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name"
                   aria-describedby="lastNameHelp" value="{{ old('last_name') }}" required>
            @error('last_name')
            <small id="lastNameHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   aria-describedby="emailHelp" value="{{ old('email') }}">
            @error('email')
            <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                   aria-describedby="phoneHelp" value="{{ old('phone') }}">
            @error('phone')
            <small id="phoneHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection

