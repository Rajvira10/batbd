@extends('admin.layout')
@section('title', 'Add Role')
@section('content')


    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Roles</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i
                                                class="ri-home-5-fill"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                                    <li class="breadcrumb-item active">Add Role</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- @include('include.message') --}}
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h3>{{ __('Add Role') }}</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('roles.store') }}" method="post" class="form-group"
                                    onsubmit="return disableOnSubmit()">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="name">
                                                    {{ __('Name') }}
                                                    <span class="text-red">*</span>
                                                </label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name') }}" placeholder="">
                                                <div class="help-block with-errors"></div>
                                                @error('name')
                                                    <span class="text-red-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="description">
                                                    {{ __('Description') }}
                                                    <span class="text-red">*</span>
                                                </label>
                                                <input id="description" type="text"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description" value="{{ old('description') }}" placeholder="">
                                                <div class="help-block with-errors"></div>
                                                @error('description')
                                                    <span class="text-red-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="submit" type="submit"
                                                class="btn btn-primary waves-effect waves-light">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('custom-script')
    <script>
        const disableOnSubmit = () => {
            const button = document.querySelector('#submit');
            button.disabled = true;
            button.innerHTML =
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`;
            return true;
        }
    </script>
@endsection
