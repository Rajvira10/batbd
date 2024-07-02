@extends('admin.layout')
@section('title', 'Disclosures')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col">
                                        <h4 class="card-title mb-0">Disclosures</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('admin.disclosures.store') }}" method="POST">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label for="disclosure">Terms & Conditions </label>
                                                <textarea class="form-control summernote" name="terms_and_conditions" id="terms_and_conditions" rows="5">{!! $disclosure->terms_and_conditions !!}</textarea>
                                                @error('terms_and_conditions')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="disclosure">Privacy Policy </label>
                                                <textarea class="form-control summernote" name="privacy_policy" id="privacy_policy" rows="5">{!! $disclosure->privacy_policy !!}</textarea>
                                                @error('privacy_policy')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end col -->
                </div>
            </div>
        </div>
    </div>

@endsection
