@extends('layouts.master')

@section('title', "Reports")

@section('content')
{{-- Modal Create / Edit Data --}}
<div class="modal fade" id="modal-data" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" id="modal-form" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title" data-type="create">Create Data Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="off">
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email" autocomplete="off">
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" class="form-control" name="phone_number" id="phone_number" autocomplete="off">
                        <div class="invalid-feedback" id="phone_number-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="identify_type">Identify Type</label>
                        <select class="form-control select2" id="identify_type" name="identify_type">
                            <option value="ktp">KTP</option>
                            <option value="sim">SIM</option>
                        </select>
                        <div class="invalid-feedback" id="identify_type-error"></div>
                    </div>
                    <div class="form-group">
                        <label>Identify Number</label>
                        <input type="number" class="form-control" name="identify_number" id="identify_number" autocomplete="off">
                        <div class="invalid-feedback" id="identify_number-error"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="pob">Birth Of Place</label>
                            <input type="text" class="form-control" name="pob" id="pob" autocomplete="off">
                            <div class="invalid-feedback" id="pob-error"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="dob">Birth Of Date</label>
                            <input type="date" class="form-control datepicker" name="dob" id="dob">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address">Jl. Surabaya Indonesia</textarea>
                        <div class="invalid-feedback" id="address-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="title">Title Report</label>
                        <input type="text" class="form-control" name="title" id="title" autocomplete="off">
                        <div class="invalid-feedback" id="title-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <div class="invalid-feedback" id="description-error"></div>
                    </div>
                    <div class="form-group mb-0">
                        <label class="form-control-label" for="image">Image Report</label>
                        <div class="custom-file">
                            <input type="file" name="image[]" class="custom-file-input" id="image" multiple>
                            <label class="custom-file-label" id="name-file">Choose File</label>
                        </div>
                        <div class="form-text text-muted">The image must have a maximum size of 2MB</div>
                        <div class="invalid-feedback d-block" id="image-error"></div>
                    </div>
                </div>  
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-button">Create</button>
                </div>
            </form> 
        </div>
    </div>
</div>

<section class="section">
    <div class="section-header">
        <h1>Report</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Report Table</h4>
            </div>
            <div class="card-body">
                @hasrole('REPORTER')
                    <button type="button" class="btn btn-primary mb-3 btn-add-data" data-toggle="modal" id="add-data-btn" data-target="#modal-data">
                        <i class="fa fa-plus-circle"></i> Add Data
                    </button>
                @endhasrole
                <div>
                    {{ $dataTable->table(['class' => 'table table-bordered']) }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
    
@push('js')
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
    <script>
        $(document).ready(function() {

            const modal = $('#modal-data');
            const modalForm = $('#modal-form');
            const modalTitle = $('#modal-title');
            const submitButton = $('#submit-button')

            // Input Image Onchange Event
            $('#image').on('change', function() {
                let totalFiles = this.files.length;
                $('#name-file').text(totalFiles + ' file(s) selected');
            });

            // Create Button Click Handle
            $(document).on('click', '.btn-add-data', function() {
                modalForm.attr('data-type', 'create');
                modalTitle.html('Add Data Category');
                submitButton.html('Create');
                
                // Clear form input
                $('#id').remove();  
                modalForm[0].reset();
                $('#image').val('');
                $('#name-file').text('Choose File');
                $('input.is-invalid, textarea.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
            });

            // Edit Button Click Handle
            $(document).on('click', '.btn-edit-data', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error Fetching Data',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });
                // const url = $(this).data('url');
                // const id = $(this).data('id');

                // // Clear form input
                // $('#id').remove();
                // modalForm[0].reset();
                // $('#image').val('');
                // $('#name-file').text('Choose File');
                // $('input.is-invalid, textarea.is-invalid').removeClass('is-invalid');
                // $('.invalid-feedback').text('');

                // modalForm.attr('data-type', 'edit');
                // modalForm.append('<input type="hidden" id="id" name="id" value="' + id + '">');
                // modalTitle.html('Edit Data Category');
                // submitButton.html('Edit');

                // $.get(url, function(response) {
                //     if (response.code == 200) {
                //         $('#name').val(response.data.name).focus();
                //         modal.modal('show');
                //     } else {
                //         Swal.fire({
                //             icon: 'error',
                //             title: 'Error Fetching Data',
                //             showConfirmButton: false,
                //             timer: 2000,
                //             timerProgressBar: true,
                //         });
                //     }
                // });
            });

            // Delete Button Click Handle
            $(document).on('click', '.btn-delete-data', function() {
                const url = $(this).data('url');
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Confirm delete this data ?',
                    text: 'If you delete this, it will be gone forever.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                })

                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                console.log(response)

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                });

                                // Refresh datatable
                                let table = $('#reports-table').DataTable();
                                table.ajax.reload();
                            },
                            error: function(response) {
                                console.log(response);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error delete data',
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true,
                                });
                            }
                        });
                    } else if (result.isDenied) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Cancel delete this data',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                        });
                    }
                });
            });

            // Form Submit Process
            modalForm.submit(function(e) {
                e.preventDefault();
                let dataType = modalForm.attr('data-type');

                if (dataType === 'create') {      
                    let formData = new FormData(modalForm[0]);
                    
                    $.ajax({
                        url: "{{ route('reports.store') }}",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        success: function(response) {
                            // Close modal
                            $('#modal-data').modal('hide');
    
                            // Clear form input
                            $('#id').remove();  
                            modalForm[0].reset();
                            $('#image').val('');
                                    $('#name-file').text('Choose File');
                            $('input.is-invalid, textarea.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').text('');
    
                            // SweetAlert notification
                            Swal.fire({
                                icon: 'success',
                                title: 'Data berhasil ditambahkan',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                            });
    
                            // Refresh datatable
                            let table = $('#reports-table').DataTable();
                            table.ajax.reload();
                        },
                        error: function(response) {
                            console.log(response)
                            if (response.status === 422) {
                                let errors = response.responseJSON.errors;
    
                                $('input.is-invalid, textarea.is-invalid').removeClass('is-invalid');
                                $('textarea.is-invalid').removeClass('is-invalid');
                                $('.invalid-feedback').text('');

                                $.each(errors, function(key, value) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key + '-error').text(value[0]);
                                });
                            }
                        }
                    });

                    return
                }
                
                let id = $('#id').val();
                let name = $('#name').val();
                let urlUpdate = "{{ route('reports.update', ':id') }}";
                let urlUpdateBinding = urlUpdate.replace(':id', id);

                $.ajax({
                    url: urlUpdateBinding,
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": name,
                    },
                    success: function(response) {
                        // Close modal
                        $('#modal-data').modal('hide');

                        // Clear form input
                        $('#id').remove();  
                        modalForm[0].reset();
                        $('#image').val('');
                        $('#name-file').text('Choose File');
                        $('input.is-invalid, textarea.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').text('');

                        // SweetAlert notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Data berhasil diupdate',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                        });

                        // Refresh datatable
                        let table = $('#reports-table').DataTable();
                        table.ajax.reload();
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;

                            $.each(errors, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key + '-error').text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush