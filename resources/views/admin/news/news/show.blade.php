@extends('admin.layout')

@section('title', 'News Details')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">News Details</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.home') }}"><i class="ri-home-5-fill"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.news') }}">News</a></li>
                                    <li class="breadcrumb-item active">News Details</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">{{ $news->title }}</h3>
                                <div class="mb-3">
                                    @if ($news->image)
                                        <img src="{{ asset($news->image) }}" alt="{{ $news->title }}"
                                            style="width: 100%; height: auto;">
                                    @else
                                        <p>No image available</p>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <strong>Status:</strong> {{ ucfirst($news->status) }}
                                </div>
                                <div class="mb-3">
                                    <strong>Published At:</strong>
                                    {{ $news->published_at ? $news->published_at->format('d M Y') : 'N/A' }}
                                </div>
                                <div class="mb-3">
                                    <strong>Author:</strong> {{ $news->user->full_name }}
                                </div>
                                <div class="mb-3">
                                    <strong>Content:</strong>
                                    <p>{!! $news->content !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
