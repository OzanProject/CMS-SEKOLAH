<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .image-card {
            cursor: pointer;
            transition: transform 0.2s;
            height: 100%;
        }
        .image-card:hover {
            transform: scale(1.05);
            border: 2px solid #007bff;
        }
        .image-preview {
            height: 150px;
            object-fit: cover;
            width: 100%;
        }
        .selected {
            border: 3px solid #28a745 !important;
            background-color: #e8f5e9;
        }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid py-3">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-images text-primary"></i> File Manager</h5>
            <div>
                <button type="button" class="btn btn-success btn-sm" id="btnSelect" disabled>
                    <i class="fas fa-check"></i> Pilih Gambar
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Upload Area -->
            <div class="mb-4 p-3 border border-dashed rounded text-center bg-white" id="dropZone">
                <p class="text-muted mb-2">Drag & Drop gambar di sini atau klik tombol di bawah</p>
                <input type="file" id="fileInput" class="d-none" accept="image/*">
                <button class="btn btn-outline-primary btn-sm" onclick="document.getElementById('fileInput').click()">
                    <i class="fas fa-cloud-upload-alt"></i> Upload Baru
                </button>
                <div id="uploadProgress" class="progress mt-2 d-none">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%">Uploading...</div>
                </div>
            </div>

            <!-- Image Grid -->
            <div class="row" id="imageGrid">
                @foreach($images as $img)
                <div class="col-6 col-md-3 col-lg-2 mb-3">
                    <div class="card image-card border" onclick="selectImage(this, '{{ $img['url'] }}')">
                        <img src="{{ $img['url'] }}" class="card-img-top image-preview" alt="{{ $img['name'] }}">
                        <div class="card-body p-2 text-center">
                            <small class="d-block text-truncate folder-name">{{ $img['name'] }}</small>
                        </div>
                    </div>
                </div>
                @endforeach
                
                @if(count($images) == 0)
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada gambar. Silakan upload terlebih dahulu.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let selectedUrl = null;

    function selectImage(element, url) {
        $('.image-card').removeClass('selected');
        $(element).addClass('selected');
        selectedUrl = url;
        $('#btnSelect').prop('disabled', false);
    }

    $('#btnSelect').click(function() {
        if (selectedUrl) {
            if (window.opener && window.opener.SetUrl) {
                // Return array of objects with url property to match LFM logic roughly
                window.opener.SetUrl([{url: selectedUrl}]);
                window.close();
            } else {
                alert('Penghubung editor tidak ditemukan! Harap Refresh halaman Settings utama lalu coba lagi.');
            }
        }
    });

    // Upload Logic
    $('#fileInput').change(function() {
        let file = this.files[0];
        if (file) uploadFile(file);
    });

    function uploadFile(file) {
        let formData = new FormData();
        formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');

        $('#uploadProgress').removeClass('d-none');

        $.ajax({
            url: '{{ route("admin.filemanager.upload") }}',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#uploadProgress').addClass('d-none');
                if (response.uploaded) {
                    location.reload(); // Refresh to see new image
                } else {
                    alert('Upload failed');
                }
            },
            error: function() {
                $('#uploadProgress').addClass('d-none');
                alert('Upload error');
            }
        });
    }
</script>
</body>
</html>
