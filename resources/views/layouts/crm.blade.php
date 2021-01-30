@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="text-uppercase mb-0">@yield('card-header-title')</h5>
                        @yield('card-header-action')
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @yield('card-body-content')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
