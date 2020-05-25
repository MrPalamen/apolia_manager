@extends('layouts.app')

@section('title', 'Casier Judiciaire')

@section('sidebar')
    <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="#" data-toggle="modal" data-target="#finesModal">
        <i class="fas fa-download fa-sm text-white-50"></i> Créer un Casier Judiciaire</a>

    <div class="modal fade" id="finesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Création d'un Casier Judiciaire</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="post" action="{{ route('records_create_post') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="number" class="form-control" placeholder="Matricule du Salarié (AB12345678)" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="surname" class="form-control" placeholder="Prénom du Salarié" required>
                                </div>
                                <div class="col">
                                    <input type="text" name="name" class="form-control" placeholder="Nom du Salarié" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Session::get('user')->name }}" placeholder="Matricule du Salarié (AB12345678)" disabled>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-4 col-form-label">Grade de l'agent</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="type" name="grade_agent">
                                    @if(Session::get('grade') === 'administrator')
                                        <option value="Colonel">Colonel</option>
                                        <option value="Commandant">Commandant</option>
                                    @endif
                                    @if(Session::get('grade') === 'h_smp' || Session::get('grade') === 'administrator')
                                            <option value="Lieutenant">Lieutenant</option>
                                            <option value="Maitre-principal (Major)">Maitre-principal (Major)</option>
                                    @endif

                                    <option value="Operator">Operator</option>
                                    <option value="Caporal">Caporal</option>
                                    <option value="Kontraktniki">Kontraktniki</option>
                                    <option value="Recrue">Recrue</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="note" placeholder="Note"></textarea>
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
