@extends('layouts.crm')

@section('card-header-title')
    Companies
@endsection

@section('card-header-action')
    <a class=" btn btn-primary" href="{{ route('companies.create') }}">New Company</a>
@endsection

@section('card-body-content')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Logo</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Website</th>
                <th scope="col">Employees</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($companies as $company)
                <tr>
                    <th class="align-middle" scope="row">{{ $company->id }}</th>
                    <td class="align-middle fit">
                        <img src="{{ $company->getFirstMediaUrl('logo') }}" class="img-thumbnail"
                             alt="{{ $company->name }}">
                    </td>
                    <td class="align-middle">{{ $company->name }}</td>
                    <td class="align-middle">{{ $company->email ?? '' }}</td>
                    <td class="align-middle">
                        @if(isset($company->website))
                            <a href="{{ $company->website }}" target="_blank"></a>{{ $company->website }}
                        @endif
                    </td>
                    <td class="align-middle">
                        <a href="{{ route('companies.employees.index', $company) }}" class="btn btn-link">{{ $company->employees_count }}</a>
                    </td>
                    <td class="align-middle">
                        <a href="{{ route('companies.show', $company) }}" class="btn btn-link">Details</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-muted text-center">
                        There isn't any companies yet. Start by
                        <a href="{{ route('companies.create') }}">adding one.</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5 w-100 d-flex justify-content-center">
        {{ $companies->links() }}
    </div>
@endsection
