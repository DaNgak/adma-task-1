@extends('layouts.master')

@section('title', "Categories")

@section('content')
{{-- Modal Create / Edit Data --}}
<div class="modal fade" id="modal-data" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form id="modal-form" data-type="create">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Create Data Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Kategori ..." name="name" id="name" autocomplete="off">
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>
                </div>  
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-button">Save changes</button>
                </div>
            </form> 
        </div>
    </div>
</div>

<section class="section">
    <div class="section-header">
        <h1>Category</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Category Table</h4>
            </div>
            <div class="card-body">
                <button type="button" class="btn btn-primary mb-3 btn-add-data" data-toggle="modal" data-target="#modal-data"><i class="fa fa-plus-circle"></i> Add Data</button>
                {{-- <form action="{{ route('categories.create') }}" method="GET">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="add-data-btn" data-target="#add-data-modal"><i class="fa fa-plus-circle"></i> Add Data</button>
                            </div>
                            <input type="text" class="form-control" name="q"
                                    placeholder="..." autocomplete="off" autofocus>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </div>
                    </div>
                </form> --}}
                {{-- class="table-responsive" Hapus Aja Ini --}}
                <div>
                    {{ $dataTable->table(['class' => 'table table-bordered']) }}
                    {{-- <table class="table table-bordered" id="categories-table">
                        <thead>
                            <tr>
                                <th>aaa</th>
                                <th>No</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table> --}}
            
                    {{-- <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 6%; text-align: center;">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col" style="width: 15%; text-align: center;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$index + ($categories->currentPage() - 1) * $categories->perPage() }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" id="{{ $category->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div style="text-align: center">
                        {{ $categories->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@push('js')
    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
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

            // Create Button Click Handle
            $(document).on('click', '.btn-add-data', function() {
                modalForm.attr('data-type', 'create');
                modalTitle.html('Add Data Category');
                submitButton.html('Create');
                
                // Clear form input
                $('#id').remove();  
                $('#name').val('');
                $('input.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
            });

             // Edit Button Click Handle
            $(document).on('click', '.btn-edit-data', function() {
                const url = $(this).data('url');
                const id = $(this).data('id');

                $('#id').remove();
                $('input.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');

                modalForm.attr('data-type', 'edit');
                modalForm.append('<input type="hidden" id="id" name="id" value="' + id + '">');
                modalTitle.html('Edit Data Category');
                submitButton.html('Edit');

                $.get(url, function(response) {
                    if (response.code == 200) {
                        $('#name').val(response.data.name).focus();
                        modal.modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Fetching Data',
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                        });
                    }
                });
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
                                let table = $('#categories-table').DataTable();
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
                    let name = $('#name').val();
    
                    $.ajax({
                        url: "{{ route('categories.store') }}",
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "name": name,
                        },
                        success: function(response) {
                            // Close modal
                            $('#modal-data').modal('hide');
    
                            // Clear form input
                            $('#name').val('');
                            $('input.is-invalid').removeClass('is-invalid');
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
                            let table = $('#categories-table').DataTable();
                            table.ajax.reload();
                        },
                        error: function(response) {
                            // Handle error response (jika diperlukan)
                            console.log(response);
    
                            if (response.status === 422) {
                                let errors = response.responseJSON.errors;
    
                                // Loop through errors and display them
                                $.each(errors, function(key, value) {
                                    // Display error message for the specific input
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
                let urlUpdate = "{{ route('categories.update', ':id') }}";
                let urlUpdateBinding = urlUpdate.replace(':id', id);

                $.ajax({
                    url: urlUpdateBinding,
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": name,
                    },
                    success: function(response) {
                        console.log(response)
                        // Close modal
                        $('#modal-data').modal('hide');

                        // Clear form input
                        $('#name').val('');
                        $('input.is-invalid').removeClass('is-invalid');
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
                        let table = $('#categories-table').DataTable();
                        table.ajax.reload();
                    },
                    error: function(response) {
                        // Handle error response (jika diperlukan)
                        console.log(response);

                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            // Loop through errors and display them
                            $.each(errors, function(key, value) {
                                // Display error message for the specific input
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