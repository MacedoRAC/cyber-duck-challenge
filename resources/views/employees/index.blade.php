@extends('layouts.crm')

@section('card-header-title')
    Employees of <a class="btn btn-link p-0" href="{{ route('companies.show', $company) }}">{{ $company->name }}</a>
@endsection

@section('card-header-action')
    <a class=" btn btn-primary" href="{{ route('companies.employees.create', $company) }}">New Employee</a>
@endsection

@section('card-body-content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($employees as $employee)
                <tr>
                    <th class="align-middle" scope="row">{{ $employee->id }}</th>
                    <td class="align-middle">{{ $employee->first_name }}</td>
                    <td class="align-middle">{{ $employee->last_name }}</td>
                    <td class="align-middle">{{ $employee->email ?? '' }}</td>
                    <td class="align-middle">{{ $employee->phone ?? '' }}</td>
                    <td class="align-middle">
                        <a href="{{ route('companies.employees.show', [$company, $employee]) }}" class="btn btn-link">Details</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-muted text-center">
                        There isn't any employees yet. Start by
                        <a href="{{ route('companies.employees.create', $company) }}">adding one.</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5 w-100 d-flex justify-content-center">
        {{ $employees->links() }}
    </div>
@endsection
