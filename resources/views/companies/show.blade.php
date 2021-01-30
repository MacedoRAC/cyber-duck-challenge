@extends('layouts.crm')

@section('card-header-title')
    Company - {{ $company->name }}
@endsection

@section('card-header-action')
    <a class=" btn btn-secondary" href="{{ route('companies.index') }}">Companies List</a>
@endsection

@section('card-body-content')
    <div class="w-100 d-flex align-items-center justify-content-center">
        <img src="{{ $company->getFirstMediaUrl('logo') }}" class="img-thumbnail w-25" alt="{{ $company->name }}">

        <dl class="my-5 row">
            <dt class="col-sm-3 text-right font-weight-bold">Name:</dt>
            <dd class="col-sm-9 text-left pl-2">{{ $company->name }}</dd>

            <dt class="col-sm-3 text-right font-weight-bold">Email:</dt>
            <dd class="col-sm-9 text-left pl-2">{{ $company->email ?? 'n/a' }}</dd>

            <dt class="col-sm-3 text-right font-weight-bold">Website:</dt>
            <dd class="col-sm-9 text-left pl-2">
                @if(isset($company->website))
                    <a href="{{ $company->website }}" target="_blank"></a>{{ $company->website }}
                @else
                    n/a
                @endif
            </dd>

            <dt class="col-sm-3 text-right font-weight-bold"># Employees:</dt>
            <dd class="col-sm-9 text-left pl-2">
                <a href="{{ route('companies.employees.index', $company) }}" class="btn btn-link p-0">
                    {{ $company->employees_count }}
                </a>
            </dd>
        </dl>
    </div>


    <div class="w-100 d-flex items-align-center justify-content-center">
        <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">Edit</a>

        <a href="#" class="btn btn-danger ml-3"
           onclick="event.preventDefault(); document.getElementById('delete-company-form').submit();">Delete</a>
        <form id="delete-company-form" action="{{ route('companies.destroy', $company) }}" method="POST" class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection
