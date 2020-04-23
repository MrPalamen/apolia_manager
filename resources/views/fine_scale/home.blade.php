@extends('layouts.app')

@section('title', "Barème d'Amende")

@section('sidebar')
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#finesModal"><i class="fas fa-download fa-sm text-white-50"></i> Création d'une amende</a>

    <div class="modal fade" id="finesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Création d'une amende</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{ route('fine_scales_create') }}">
                    @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="type" class="col-form-label">Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="Vol">Vol</option>
                                <option value="Ordre public">Ordre public</option>
                                <option value="Armement">Armement</option>
                                <option value="Délits majeur">Délits majeur</option>
                                <option value="Stupéfiant">Stupéfiant</option>
                                <option value="Marché Noir">Marché Noir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" placeholder="Nom de Amende" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="number" name="point" class="form-control" placeholder="Retrait Point(s)" required>
                                </div>
                                <div class="col">
                                    <input type="number" name="price" class="form-control" placeholder="Prix de l'Amende (₽)" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="option" placeholder="Option"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
                </form>
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
                            url: '{{ route('fine_scales_delete') }}',
                            data: 'id=' + productId,
                            type: 'POST',
                            cache: false,
                            success: function () {
                                window.LaravelDataTables["finescale-table"].ajax.reload(null, false);
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

