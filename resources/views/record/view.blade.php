@extends('layouts.app')

@section('title', "Casier Judiciaire")

@section('sidebar')
    <div class="btn-group ml-auto " role="group" aria-label="Basic example">
        <a class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" href="{{ route('records_edit', $view->id) }}">
            Editer le Casier Judiciaire
        </a>
        <a class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" href="{{ route('fines', $view->id) }}">
           Ajouter d'une amende
        </a>
    </div>
@endsection

@section('content')
                    <div class="row">
                        <div class="col-md-8 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 pr-1">
                                                <div class="form-group">
                                                    <label>Matricule du Salarié (AB12345678)</label>
                                                    <input type="text" class="form-control" placeholder="Matricule du Salarié (AB12345678)" value="{{ $view->number  }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 px-1">
                                                <div class="form-group">
                                                    <label>Prénom du Salarié</label>
                                                    <input type="text" class="form-control" placeholder="Prénom du Salarié" value="{{ $view->surname  }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pl-1">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nom du Salarié</label>
                                                    <input type="email" class="form-control" placeholder="Nom du Salarié" value="{{ $view->name  }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Total des points</label>
                                                    <input type="text" class="form-control" placeholder="Nom de l'agent" value="{{ $number }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Amende non payée (₽) (Impayé)</label>
                                                    <input type="text" class="form-control" placeholder="Amende non payée (₽) (Impayé)" value="{{ $view->credit }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pr-1">
                                                <div class="form-group">
                                                    <label>Nom de l'agent</label>
                                                    <input type="text" class="form-control" placeholder="Nom de l'agent" value="{{ $view->name_agent }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-3 pl-1">
                                                <div class="form-group">
                                                    <label>Grade de l'agent</label>
                                                    <input type="text" class="form-control" placeholder="Grade de l'agent" value="{{ $view->grade_agent }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Note</label>
                                                    <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" readonly>{{ $view->note }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-4">
                            @foreach($find as $key => $value)
                                <div class="card">
                                    <div class="card-header d-flex flex-row align-items-center">
                                        <p class="float-left">{{ $value['type'] .' | '. $value['name'] }}</p>

                                        <div class="btn-group ml-auto " role="group" aria-label="Basic example">
                                            <a href="{{ route('fines_edit', $value['id']) }}" class="btn btn-primary btn-sm " style="align-items: center" role="button">
                                               Editer d'une amende
                                            </a>
                                            @if(Session::get('grade') === 'administrator' || Session::get('grade') === 'h_smp')
                                            <button id="deleteBtn" type="button" data-id="{{ $value['id'] }}" class="btn btn-danger btn-sm" style="align-items: center">
                                                supprimer
                                            </button>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-primary">
                                            Option <span class="badge badge-light">{{ $value['option'] }}</span>
                                        </button>
                                        <hr>
                                        <button type="button" class="btn btn-primary">
                                            Retrait Point(s) <span class="badge badge-light">{{ $value['points'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            Prix de l'Amende (₽) <span class="badge badge-light">{{ $value['price'] }}</span>
                                        </button>
                                        <hr>
                                        <button type="button" class="btn btn-primary">
                                            Creation <span class="badge badge-light">{{ $value['created_at'] }}</span>
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            Updated <span class="badge badge-light">{{ $value['updated_at'] }}</span>
                                        </button>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>
@endsection
@push('scripts')
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
                            url: '{{ route('fines_delete') }}',
                            data: 'id=' + productId,
                            type: 'POST',
                            cache: false,
                            success: function (result) {
                                console.log(result)
                                Swal.fire('Deleted!', 'The member was deleted successfully.')
                                location.reload(true);
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
