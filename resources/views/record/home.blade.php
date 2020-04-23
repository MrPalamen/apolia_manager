@extends('layouts.app')

@section('title', 'Casier Judiciaire')

@section('sidebar')
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#finesModal">
        <i class="fas fa-download fa-sm text-white-50"></i> Créer un Casier Judiciaire</a>

    <div class="modal fade" id="finesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('fines_create') }}">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                {{$dataTable->table()}}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
    <script>
        $(function () {
            $(document).on('click', '#deleteBtn', function(e){
                const productId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "It will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    allowOutsideClick: false,
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                    return new Promise(function(resolve) {
                        setTimeout(function() {
                            resolve()
                        }, 2000)
                    })
                }
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: '{{ route('records_delete') }}',
                            data: 'id=' + productId,
                            type: 'POST',
                            cache: false,
                            success: function () {
                                window.LaravelDataTables["Record-table"].ajax.reload(null, false);
                                Swal.fire('Deleted!', 'The member was deleted successfully.')
                            },
                            error: function (result) {
                                console.log(result)
                            }
                        });
                    }
                });
            });
        });
    </script>

@endpush
