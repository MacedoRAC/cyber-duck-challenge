@extends('layouts.crm')

@section('card-header-title')
    Employee - {{ $employee->full_name }}
@endsection

@section('card-header-action')
    <a class=" btn btn-secondary" href="{{ route('companies.employees.index', $company) }}">Employees List</a>
@endsection

@section('card-body-content')
    <dl class="my-5 row">
        <dt class="col-sm-3 text-right font-weight-bold">First Name:</dt>
        <dd class="col-sm-9 text-left pl-2">{{ $employee->first_name }}</dd>

        <dt class="col-sm-3 text-right font-weight-bold">Last Name:</dt>
        <dd class="col-sm-9 text-left pl-2">{{ $employee->last_name }}</dd>

        <dt class="col-sm-3 text-right font-weight-bold">Email:</dt>
        <dd class="col-sm-9 text-left pl-2">{{ $employee->email ?? 'n/a' }}</dd>

        <dt class="col-sm-3 text-right font-weight-bold">Phone:</dt>
        <dd class="col-sm-9 text-left pl-2">{{ $employee->phone ?? 'n/a' }}</dd>
    </dl>


    <div class="w-100 d-flex items-align-center justify-content-center">
        <a href="{{ route('companies.employees.edit', [$company, $employee]) }}" class="btn btn-warning">Edit</a>

        <a href="#" class="btn btn-danger ml-3"
           onclick="event.preventDefault(); document.getElementById('delete-employee-form').submit();">Delete</a>
        <form id="delete-employee-form" action="{{ route('companies.employees.destroy', [$company, $employee]) }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
