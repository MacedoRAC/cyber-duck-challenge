@extends('layouts.crm')

@section('card-header-title')
    Adding new Company
@endsection

@section('card-header-action')
    <a class=" btn btn-secondary" href="{{ route('companies.index') }}">Companies List</a>
@endsection

@section('card-body-content')
    <form method="post" enctype="multipart/form-data" action="{{ route('companies.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="required">Company name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   aria-describedby="nameHelp" value="{{ old('name') }}" required>
            @error('name')
            <small id="nameHelp" class="form-text text-danger">{{ $message }}</small>
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
            <label for="website">Website</label>
            <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website"
                   aria-describedby="websiteHelp" value="{{ old('website') }}">
            @error('website')
            <small id="websiteHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" id="logo" name="logo"
                       accept="image/png, image/jpeg"
                       aria-describedby="logoHelp">
                <label class="custom-file-label" for="logo">Choose logo</label>
            </div>
            @error('logo')
            <small id="logoHelp" class="form-text text-danger">{{ $message }}</small>
            @enderror

            <script type="application/javascript">
                $('input[name="logo"]').change(function(e){
                    let fileName = e.target.files[0].name;
                    $('.custom-file-label').html(fileName);
                });
            </script>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection

