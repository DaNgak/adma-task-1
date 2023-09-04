@extends('layouts.master')

@section('title', "Report Trackers")

@section('content')
{{-- Modal Create / Edit Data --}}
<div class="modal fade" id="modal-data" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" id="modal-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title" data-type="create">Edit Data Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div>Title</div>
                        <div class="form-control" id="title"></div>
                    </div>
                    <div class="form-group">
                        <div>Ticket</div>
                        <div class="form-control" id="ticket"></div>
                    </div>
                    <div class="form-group">
                        <div>Reporter</div>
                        <div class="form-control" id="reporter"></div>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control select2" id="category_id" name="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="category_id-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control select2" id="status" name="status">
                            @foreach ($status as $s)
                                <option value="{{ $s }}">{{ $s }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="status-error"></div>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                        <div class="invalid-feedback" id="notes-error"></div>
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
        <h1>Report Trackers</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Report Trackers Table</h4>
            </div>
            <div class="card-body">
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

            // Edit Button Click Handle
            $(document).on('click', '.btn-edit-data', function() {
                const url = $(this).data('url');
                const id = $(this).data('id');
                // Clear form input
                $('#id').remove();
                modalForm[0].reset();
                $('input.is-invalid, textarea.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
// 
                modalForm.attr('data-type', 'edit');
                modalForm.append('<input type="hidden" id="id" name="id" value="' + id + '">');
                modalTitle.html('Edit Data Category');
                submitButton.html('Edit');

                $.get(url, function(response) {
                    if (response.code == 200) {
                        $('#title').text(response.data.title);
                        $('#ticket').text(response.data.ticket_id);
                        $('#reporter').text(response.data.reporter);
                        $('#status').val(response.data.status);
                        $('#category_id').val(response.data.category_id);
                        $('#notes').val();
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

            // // Delete Button Click Handle
            // $(document).on('click', '.btn-delete-data', function() {
            //     const url = $(this).data('url');
            //     const id = $(this).data('id');

            //     Swal.fire({
            //         title: 'Confirm delete this data ?',
            //         text: 'If you delete this, it will be gone forever.',
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonText: 'Yes, delete!',
            //     })

            //     .then((result) => {
            //         if (result.isConfirmed) {
            //             $.ajax({
            //                 url: url,
            //                 method: 'DELETE',
            //                 data: {
            //                     "_token": "{{ csrf_token() }}",
            //                 },
            //                 success: function(response) {
            //                     console.log(response)

            //                     Swal.fire({
            //                         icon: 'success',
            //                         title: 'Data berhasil dihapus',
            //                         showConfirmButton: false,
            //                         timer: 2000,
            //                         timerProgressBar: true,
            //                     });

            //                     // Refresh datatable
            //                     let table = $('#reports-table').DataTable();
            //                     table.ajax.reload();
            //                 },
            //                 error: function(response) {
            //                     console.log(response);
            //                     Swal.fire({
            //                         icon: 'error',
            //                         title: 'Error delete data',
            //                         showConfirmButton: false,
            //                         timer: 2000,
            //                         timerProgressBar: true,
            //                     });
            //                 }
            //             });
            //         } else if (result.isDenied) {
            //             Swal.fire({
            //                 icon: 'info',
            //                 title: 'Cancel delete this data',
            //                 showConfirmButton: false,
            //                 timer: 2000,
            //                 timerProgressBar: true,
            //             });
            //         }
            //     });
            // });

            // Form Submit Process
            modalForm.submit(function(e) {
                e.preventDefault();

                let id = $('#id').val();
                let category_id = $('#category_id').val();
                let status = $('#status').val();
                let notes = $('#notes').val();
                let urlUpdate = "{{ route('reports.update', ':id') }}";
                let urlUpdateBinding = urlUpdate.replace(':id', id);

                $.ajax({
                    url: urlUpdateBinding,
                    method: 'PUT',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "category_id": category_id,
                        "status": status,
                        "notes": notes
                    },
                    success: function(response) {
                        // Close modal
                        $('#modal-data').modal('hide');

                        // Clear form input
                        $('#id').remove();  
                        $('#category_id').val('');
                        $('#status').val('');
                        $('#notes').val('');
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
                        let table = $('#reporttrackers-table').DataTable();
                        table.ajax.reload();
                    },
                    error: function(response) {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;

                            $('input.is-invalid, textarea.is-invalid').removeClass('is-invalid');
                            $('.invalid-feedback').text('');

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