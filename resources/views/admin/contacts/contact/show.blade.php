@extends('admin.layout')
@section('title', 'Message Details')
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Message Details</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i
                                                class="ri-home-5-fill"></i></a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.contacts') }}">Messages</a></li>
                                    <li class="breadcrumb-item active">Message Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Details Section -->
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Message Details</h4>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $contact->name }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $contact->email }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Phone Number</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $contact->phone_number }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Subject</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $contact->subject }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Message</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $contact->message }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href="{{ route('admin.contacts') }}" class="btn btn-secondary">Back to Messages</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Contact Details Section -->
            </div>
        </div>
    </div>

@endsection
