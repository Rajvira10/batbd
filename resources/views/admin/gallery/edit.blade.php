@extends('admin.layout')
@section('title', 'Edit Gallery')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Galleries</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i
                                                class="ri-home-5-fill"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.galleries') }}">Galleries</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Gallery</li>
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
                                <h3>{{ __('Edit Gallery') }}</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="post"
                                    class="form-group" onsubmit="return disableOnSubmit()">
                                    @csrf
                                    @method('POST')
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="name">
                                                    {{ __('Name') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ old('name', $gallery->name) }}" placeholder="">
                                                <div class="help-block with-errors"></div>
                                                @error('name')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="status">
                                                    {{ __('Status') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select id="status"
                                                    class="form-control select-category @error('status') is-invalid @enderror"
                                                    name="status">
                                                    <option value="Active"
                                                        {{ old('status', $gallery->status) == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="Inactive"
                                                        {{ old('status', $gallery->status) == 'inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                                @error('status')
                                                    <span class="text-danger" role="alert">
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
                                                </label>
                                                <textarea name="description" id="description" cols="30" rows="6"
                                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $gallery->description) }}</textarea>
                                                <div class="help-block with-errors"></div>
                                                @error('description')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button id="submit" type="submit"
                                                class="btn btn-primary waves-effect waves-light">Update</button>
                                        </div>
                                    </div>
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
        document.addEventListener("DOMContentLoaded", function() {
            const selectCategory = document.querySelector(".select-category");
            new Selectr(selectCategory);
        });

        const disableOnSubmit = () => {
            const button = document.querySelector('#submit');
            button.disabled = true;
            button.innerHTML =
                `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`;
            return true;
        }
    </script>
@endsection
