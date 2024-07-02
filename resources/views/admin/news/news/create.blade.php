@extends('admin.layout')
@section('title', 'Create News')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">News</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i
                                                class="ri-home-5-fill"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.news') }}">News</a></li>
                                    <li class="breadcrumb-item active">Add News</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>{{ __('Add News') }}</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.news.store') }}" method="post" class="form-group"
                                    onsubmit="return disableOnSubmit()" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="title">
                                                    {{ __('Title') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input id="title" type="text"
                                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                                    value="{{ old('title') }}" placeholder="Title">
                                                <div class="help-block with-errors"></div>
                                                @error('title')
                                                    <span class="text-danger-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="author">
                                                    {{ __('Image') }}
                                                </label>
                                                <input id="image" type="file"
                                                    class="form-control @error('image') is-invalid @enderror" name="image"
                                                    value="{{ old('image') }}">
                                                <div class="help-block with-errors"></div>
                                                @error('image')
                                                    <span class="text-danger-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="content">
                                                    {{ __('Content') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <textarea id="content" name="content" class="form-control summernote @error('content') is-invalid @enderror"
                                                    placeholder="Content">{{ old('content') }}</textarea>
                                                <div class="help-block with-errors"></div>
                                                @error('content')
                                                    <span class="text-danger-error" role="alert">
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
