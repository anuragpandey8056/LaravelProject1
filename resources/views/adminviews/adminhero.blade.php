@extends('adminlayout.adminmaster')
@section('content')



<div >


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css">

<!-- DataTables Buttons Extension CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- DataTables core -->
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>

<!-- DataTables Buttons Extension -->
<script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script>

<!-- JSZip for Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- pdfmake for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.8.4/axios.min.js" integrity="sha512-2A1+/TAny5loNGk3RBbk11FwoKXYOMfAK6R7r4CpQH7Luz4pezqEGcfphoNzB7SM4dixUoJsKkBsB6kg+dNE2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Document</title>
</head>



<body>
<div class="container mt-5">
    <h2 class="mb-4 text-primary fw-bold">Banner Image Management</h2>

    <!-- Add Product Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <button type="button" class="btn btn-primary rounded-pill shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#addheroModal">
            <i class="fas fa-plus me-2"></i> Add New Image
        </button>
        <div id="message" class="flex-grow-1 text-end"></div>
    </div>

    <div class="card shadow border-0 rounded-4 mb-5">
        <div class="card-header bg-light border-0 py-3">
            <h5 class="mb-0 text-dark">Banner Images</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 border-0 display nowrap" id="Herotable">
                    <thead>
                        <tr class="bg-light">
                            <th scope="col" class="px-4 py-3">#</th>
                            <th scope="col" class="px-4 py-3">Description</th>
                            <th scope="col" class="px-4 py-3">Image</th>
                            <th scope="col" class="px-4 py-3">Status</th>
                            <th scope="col" class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="heroTable" class="bg-white">
                        @forelse($heros as $index => $hero)
                        <tr id="hero_{{ $hero->id }}">
                            <td class="px-4">{{$hero->id}}</td>
                            <td class="px-4">{{$hero->description }}</td>
                            <td class="px-4">
                                @if($hero->url)
                               
                                <img src="/Upload/Banner/{{ basename($hero->url) }}"
                                     style="width: 120px; height: 70px; object-fit: cover; border-radius: 0.75rem; cursor: pointer; border: 1px solid #eee"
                                     class="product-img shadow-sm"
                                     alt="Image">
                                @else
                                <span class="text-muted fst-italic">No Image</span>
                                @endif
                            </td>
                            <td class="px-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggleStatus" 
                                           type="checkbox"
                                           role="switch"
                                           data-id="{{ $hero->id }}"
                                           {{ $hero->status ? 'checked' : '' }}
                                           style="transform: scale(1.2);">
                                </div>
                            </td>
                            <td class="px-4">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary btn-sm editheroBtn rounded-pill px-3"
                                        data-id="{{$hero->id }}"
                                        data-bs-toggle="modal" data-bs-target="#editheroModal">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                    <button class="btn btn-outline-danger btn-sm deleteheroBtn rounded-pill px-3"
                                        data-id="{{$hero->id }}">
                                        <i class="fas fa-trash-alt me-1"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">
                                <i class="fas fa-image fa-3x mb-3 text-light"></i>
                                <p>No banner images found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addheroModal" tabindex="-1" aria-labelledby="addheroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="heroForm" enctype="multipart/form-data" class="modal-content border-0 shadow">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="addheroModalLabel">Add New Banner Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="form-group mb-4">
                    <label class="form-label fw-semibold">Description:</label>
                    <textarea name="description" class="form-control border rounded-3" rows="3" required></textarea>
                    <span class="text-danger error-text description_error small"></span>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">Image:</label>
                    <input type="file" name="image" class="form-control border rounded-3" accept="image/*" required />
                    <span class="text-danger error-text image_error small"></span>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Save Image</button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editheroModal" tabindex="-1" aria-labelledby="editheroModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="editheroForm" enctype="multipart/form-data" class="modal-content border-0 shadow">
            <input type="hidden" name="hero_id" id="editheroId">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="editheroModalLabel">Edit Banner Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="form-group mb-4">
                    <label class="form-label fw-semibold">Description:</label>
                    <textarea name="description" id="editheroDescription" class="form-control border rounded-3" rows="3" required></textarea>
                    <span class="text-danger error-text description_error small"></span>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label fw-semibold">Image:</label>

                    <!-- Image preview -->
                    <div id="image-preview" class="mb-3 text-center">
                        <img id="edit-preview-image" src="" alt="Current Image" class="img-fluid rounded-3 border" style="max-height: 150px; max-width: 100%; display: none;" />
                    </div>

                    <!-- File input -->
                    <input type="file" name="image" class="form-control border rounded-3" accept="image/*" />
                    <span class="text-danger error-text image_error small"></span>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary rounded-pill px-4">Update Image</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-white" id="imagePreviewLabel">Image Preview</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="previewImage" src="" alt="Preview" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap & jQuery -->
    
    <script>
 new DataTable('#Herotable', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    },
    // This runs after table initialization
    initComplete: function() {
        // Style the buttons after they are created
        setTimeout(function() {
            // Add custom icons to buttons
            $('.dt-button:contains("Copy")').html('<i class="fas fa-copy me-1"></i> Copy').addClass('btn-outline-secondary rounded-pill mx-1 shadow-sm');
            $('.dt-button:contains("CSV")').html('<i class="fas fa-file-csv me-1"></i> CSV').addClass('btn-outline-success rounded-pill mx-1 shadow-sm');
            $('.dt-button:contains("Excel")').html('<i class="fas fa-file-excel me-1"></i> Excel').addClass('btn-outline-primary rounded-pill mx-1 shadow-sm');
            $('.dt-button:contains("PDF")').html('<i class="fas fa-file-pdf me-1"></i> PDF').addClass('btn-outline-danger rounded-pill mx-1 shadow-sm');
            $('.dt-button:contains("Print")').html('<i class="fas fa-print me-1"></i> Print').addClass('btn-outline-dark rounded-pill mx-1 shadow-sm');
            
            // Add a wrapper and label
            $('.dt-buttons').wrapAll('<div class="export-buttons-wrapper py-2 px-3 bg-white rounded-pill shadow-sm d-inline-flex align-items-center"></div>');
            $('.export-buttons-wrapper').prepend('<span class="me-2 text-muted fw-medium" style="font-size: 0.85rem;">Export:</span>');
            
            // Add custom styles
            $('head').append(`
                <style>
                    .dt-button {
                        background-color: transparent !important;
                        border-radius: 50px !important;
                        margin: 0 3px !important;
                        transition: all 0.2s !important;
                        font-size: 0.85rem !important;
                    }
                    .dt-button:hover {
                        transform: translateY(-2px) !important;
                        box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
                    }
                </style>
            `);
        }, 100); // Small delay to ensure buttons are rendered
    }
});

    // Show image in modal
    $(document).on('click', '.product-img', function() {
        const imageUrl = $(this).attr('src');
        $('#previewImage').attr('src', imageUrl);
        $('#imagePreviewModal').modal('show');
    });

    // Add Product AJAX
    $('#heroForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        // Clear old errors
        $('.error-text').text('');

        $.ajax({
            url: 'herosaveitem',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $('#message').html(`<div class="alert alert-success">${response.success}</div>`);
                $('#heroForm')[0].reset();
                $('#addheroModal').modal('hide');
                $('#addheroModal').on('hidden.bs.modal', function () {
                    $('body').removeClass('modal-open');
                    $('body').css('overflow', 'auto');
                    $('body').css('padding-right', '');
                    $('.modal-backdrop').remove();
                });
                let newRow = `<tr id="hero_${response.hero.id}">
                    <td>${response.hero.id}</td>
                    <td>${response.hero.description}</td>
                    <td><img src="${response.hero.image}" class="product-img" alt="Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 0.5rem; cursor: pointer;"></td>
                    <td>${response.hero.status}</td>
                    <td><button class="btn btn-warning btn-sm editheroBtn" data-id="${response.hero.id}">Edit</button>
                    <button class="btn btn-danger btn-sm deleteproductBtn" data-id="${response.hero.id}">Delete</button></td>
                </tr>`;
                $('#heroTable').prepend(newRow);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        $(`.error-text.${field}_error`).text(messages[0]);
                    });
                } else {
                    $('#message').html(`<div class="alert alert-danger">Something went wrong.</div>`);
                }
            }
        });
    });

    // Edit Product AJAX - Load Product Data into Modal
    $(document).on('click', '.editheroBtn', function() {
        let heroId = $(this).data('id');

        $.ajax({
            url: `${heroId}/edit`,  // <-- Use backticks here
            type: 'GET',
            success: function(response) {
                $('#editheroId').val(response.hero.id);
                $('#editheroDescription').val(response.hero.description);
                $('#editstatus').val(response.hero.status);
                if (response.hero.image) {
                let imagePath = `/Upload/Banner/${response.hero.image.split('/').pop()}`;
                row.find('td:nth-child(3) img').attr('src', imagePath);
}
            }
        });
    });

    // Update Product AJAX
    $('#editheroForm').submit(function(e) {
        e.preventDefault();
        let heroId = $('#editheroId').val();
        let formData = new FormData(this);

        $.ajax({
            url: `/${heroId}/update`, // <-- Use backticks here
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(response) {
                $('#message').html(`<div class="alert alert-success">${response.success}</div>`);
                $('#editheroForm')[0].reset();  // Correctly reset the form
                $('#editheroModal').modal('hide');
                $(`#hero_${response.hero.id} td:nth-child(2)`).text(response.hero.description);  // Correctly update description
                $(`#hero_${response.hero.id} td:nth-child(3)`).text(response.hero.status);   // Correctly update status
                $(`#hero_${response.hero.id} td:nth-child(4) img`).attr('src', response.hero.image);  // Correctly update image source
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        $(`.error-text.${field}_error`).text(messages[0]);
                    });
                } else {
                    $('#message').html(`<div class="alert alert-danger">Something went wrong.</div>`);
                }
            }
        });
    });

    // Toggle status
    $(document).on('change', '.toggleStatus', function () {
        const heroId = $(this).data('id');
        const newStatus = $(this).is(':checked') ? 1 : 0;

        axios.post(`toggle-status/${heroId}`, {  // <-- Use backticks here
            status: newStatus
        }, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            Swal.fire('Success', response.data.message, 'success');
            // Reset all toggle buttons except the clicked one
            $('.toggleStatus').not(this).prop('checked', false);
        })
        .catch(error => {
            console.error(error);
            Swal.fire('Error', 'Could not update status.', 'error');
        });
    });

    // Delete Product AJAX with Event Delegation
    $(document).on('click', '.deleteheroBtn', function(e) {
        e.preventDefault();

        const heroId = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'This will delete the product permanently!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then(result => {
            if (result.isConfirmed) {
                axios.delete(`delete/${heroId}`, {  // <-- Use backticks here
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    Swal.fire('Deleted!', response.data.success, 'success');
                    $(`#hero_${heroId}`).remove(); // Correctly remove the product row
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error!', 'There was a problem deleting the product.', 'error');
                });
            }
        });
    });
</script>


@endsection