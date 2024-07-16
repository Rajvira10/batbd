@extends('admin.layout')
@section('title', 'Media')

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{ implode('', $errors->all(':message')) }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <h4 class="mb-3 mb-md-0">Media of {{ $gallery->name }}</h4>
                                <div class="d-flex flex-column flex-md-row align-items-center">
                                    <input type="text" id="searchInput"
                                        class="form-control mb-3 mb-md-0 me-md-4 w-100 w-md-auto" style="max-width: 400px;"
                                        placeholder="Search media...">
                                    {{-- @if (auth()->user()->authorize('medias.create')) --}}
                                    <button class="btn d-flex btn-success" data-bs-toggle="modal"
                                        data-bs-target="#addMediaModal">
                                        <i class="ri-add-line align-bottom me-1"></i>
                                        Add
                                    </button>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>



                        <input type="hidden" name="gallery_id" id="gallery_id" value={{ $id }}>
                        <div class="media-grid">
                            @foreach ($medias as $item)
                                <div class="media-item mb-4" style="" data-name="{{ $item->name }}">
                                    <img src="{{ asset($item->relative_path) }}" class="card-img-top"
                                        alt="{{ $item->name }}" data-bs-toggle="modal" data-bs-target="#mediaModal"
                                        data-id="{{ $item->id }}">
                                </div>
                            @endforeach

                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $medias->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="addMediaModal" tabindex="-1" aria-labelledby="addMediaModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addMediaModalLabel">Add New Item</h5>
                        </div>
                        <div class="modal-body">
                            <form id="addMediaForm" action="{{ route('admin.medias.store', $id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="mediaUpload">Upload or Drag and Drop Files</label>
                                    <div id="mediaUpload" class="border p-4 text-center">
                                        <input type="file" class="form-control fileSection" id="file" name="file[]"
                                            multiple required>
                                        <div id="dragDropArea" class="mt-3">Click or Drop files here</div>
                                        <div id="fileList" class="mt-3"></div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mediaModalLabel">Media Details</h5>
                        </div>
                        <div class="modal-body">
                            <img id="mediaImage" src="" alt="" class="img-fluid mb-3">
                            <div class="form-group">
                                <label for="mediaTitle">Name</label>
                                <input type="text" class="form-control" id="mediaTitle">
                            </div>
                            <div class="form-group mt-2 mb-3">
                                <label for="mediaURL">URL</label>
                                <input type="text" class="form-control" id="mediaURL" readonly disabled>
                            </div>
                            <button class="btn btn-secondary" id="copyURL">Copy URL</button>
                            <button class="btn btn-info" id="downloadMedia">Download</button>
                            <button class="btn btn-success" type="button" id="updateMedia">Update</button>
                            <button class="btn btn-danger" id="deleteMedia">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .fileSection {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
        }

        .media-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .media-item {
            height: 140px;
            width: 140px;
            border: 1px solid #d6d6d6;
            box-shadow: inset 0 0 5px #eeeeee;
        }

        .media-item img {
            height: 140px;
            width: 140px;
            object-fit: cover;
            cursor: pointer;
        }

        #mediaUpload {
            background-color: #f8f9fa;
            border: 2px dashed #ced4da;
        }

        #dragDropArea {
            height: 150px;
            background-color: #f8f9fa;
            border: 2px dashed #ced4da;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #fileList ul {
            list-style-type: none;
            padding: 0;
        }

        #fileList ul li {
            padding: 0.5rem;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            margin-bottom: 0.5rem;
        }
    </style>
@endsection

@section('custom-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('searchInput').addEventListener('input', function(e) {
                const searchQuery = e.target.value.toLowerCase();
                document.querySelectorAll('.media-item').forEach(function(item) {
                    const itemName = item.getAttribute('data-name').toLowerCase();
                    if (itemName.includes(searchQuery)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });

            $('#mediaModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const mediaId = button.data('id');
                const mediaItem = button.closest('.media-item');
                const mediaName = mediaItem.attr('data-name');
                const mediaURL = mediaItem.find('img').attr('src');

                const modal = $(this);
                modal.find('#mediaImage').attr('src', mediaURL);
                modal.find('#mediaTitle').val(mediaName);
                modal.find('#mediaURL').val(mediaURL);

                $('#copyURL').off('click').on('click', function() {
                    var copyInput = document.getElementById('mediaURL').value;
                    const copyContent = async () => {
                        try {
                            await navigator.clipboard.writeText(copyInput);
                            toaster('URL copied to clipboard', 'success');
                        } catch (err) {
                            toaster('Only works in HTTPs', 'danger');
                        }
                    };
                    copyContent();
                });

                $('#downloadMedia').off('click').on('click', function() {
                    const a = document.createElement('a');
                    a.href = mediaURL;
                    a.download = mediaName;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                });

                $('#updateMedia').off('click').on('click', function() {
                    $.ajax({
                        url: '{{ route('admin.medias.update') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _token: '{{ csrf_token() }}',
                            media_id: mediaId,
                            name: $('#mediaTitle').val()
                        },
                        success: function(response) {
                            if (response.success) {
                                toaster(response.success, 'success');
                                $('#mediaModal').modal('hide');
                                $('.media-item[data-name="' + $('#mediaTitle').val() +
                                        '"]')
                                    .find('img').attr('alt', $('#mediaTitle').val());
                                mediaItem.attr('data-name', $('#mediaTitle').val());
                            } else {
                                toaster(response.error, 'danger');
                            }
                        }
                    });
                });

                $('#deleteMedia').off('click').on('click', function() {
                    $.ajax({
                        url: '{{ route('admin.medias.destroy') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            media_id: mediaId
                        },
                        success: function(response) {
                            if (response.success) {
                                toaster(response.success, 'success');
                                $('#mediaModal').modal('hide');
                                $('.media-item[data-name="' + mediaName + '"]')
                                    .remove();
                            } else {
                                toaster(response.error, 'danger');
                            }
                        }
                    });
                });
            });

            const dragDropArea = document.getElementById('dragDropArea');
            const fileInput = document.getElementById('file');
            const fileList = document.getElementById('fileList');

            const updateFileList = (files) => {
                fileList.innerHTML = '';
                if (files.length > 0) {
                    const fileNames = Array.from(files).map(file => `<li>${file.name}</li>`).join('');
                    fileList.innerHTML = `<ul>${fileNames}</ul>`;
                } else {
                    fileList.innerHTML = 'No files selected.';
                }
            };

            dragDropArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dragDropArea.classList.add('dragging');
            });

            dragDropArea.addEventListener('dragleave', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dragDropArea.classList.remove('dragging');
            });

            dragDropArea.addEventListener('drop', (e) => {
                e.preventDefault();
                e.stopPropagation();
                dragDropArea.classList.remove('dragging');

                const files = e.dataTransfer.files;
                fileInput.files = files;
                updateFileList(files);
            });

            fileInput.addEventListener('change', (e) => {
                updateFileList(e.target.files);
            });

            document.getElementById('addMediaForm').addEventListener('submit', function(e) {
                const files = document.getElementById('file').files;
                if (files.length === 0) {
                    e.preventDefault();
                    alert('Please select files to upload.');
                }
            });
        });
    </script>
@endsection
