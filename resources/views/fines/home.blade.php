@extends('layouts.app')

@section('title', 'Ajouter un amende')

@section('sidebar')
    <form id="form">
        <div class="form-row">
            <div class="form-group col-6">
                <select class="custom-select" name="finescale" id="finescale">
                    @foreach($fines as $key => $value)
                        <option value="{{ $key }}">{{ $value['type'].' | '.$value['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-6"><input type="submit" class="mb-2 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" value="Insert" />
            </div>
        </div>
    </form>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card md-4">
                <h5 class="card-header">
                    Fréquence Radio
                </h5>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr class="table">
                            <td>
                                Prénom du Salarié
                            </td>
                            <td>
                                {{ $record->surname }}
                            </td>

                        </tr>
                        <tr class="table">
                            <td>
                                Nom du Salarié
                            </td>
                            <td>
                                {{ $record->name }}
                            </td>

                        </tr>
                        <tr class="table">
                            <td>
                                Matricule du Salarié
                            </td>
                            <td>
                                {{ $record->number }}
                            </td>

                        </tr>
                        <tr class="table">
                            <td>
                                Commentaire de l'arrestation
                            </td>
                            <td>
                                {{ $record->note }}
                            </td>

                        </tr>
                        <tr class="table">
                            <td>
                                Total des amende non payée
                            </td>
                            <td>
                                {{ $record->credit }}
                            </td>

                        </tr>
                        <tr class="table">
                            <td>
                                Nombre total des points
                            </td>
                            <td>
                                {{ $number }}
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <br>
    <form method="post" action="{{ route('fines_create') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $record->id }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card md-4">
                        <h5 class="card-header">
                            Editeur des Fréquence Radio
                        </h5>
                        <div class="card-body">
                            <div class="table-repsonsive">
                                <span id="error"></span>
                                <table class="table table-bordered" id="item_table">
                                    <thead>
                                    <tr>
                                        <th>type</th>
                                        <th>name</th>
                                        <th>points</th>
                                        <th>price</th>
                                        <th>option</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody ></tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="points">Retrait Point(s)</label>
                                        <input type="number" class="form-control" id="points" name="points" placeholder="Retrait Point(s)" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="price">Prix de l'Amende (₽)</label>
                                        <input type="number" min="1" class="form-control" id="price" name="price" placeholder="Prix des Amendes (₽)" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="credit">Amende non payée (₽) (Impayé)</label>
                                <input type="number" min="0" class="form-control" id="credit" name="credit" placeholder="Impayé" required>
                            </div>
                                <div align="center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            const ar = {!! json_encode($fines) !!};
            let count = 0;
            $("#form").submit(function(event){
                const num = ar[$('#finescale').val()];
                count++;
                let option = ''
                if(num.option !== null){
                    option = num.option
                }
                let html = '';
                html += '<tr>';
                html += '<td><input type="text" name="item_type['+count+']" class="form-control" value="'+num.type+'" readonly/></td>';
                html += '<td><input type="text" name="item_name['+count+']" class="form-control" value="'+num.name+'" readonly/></td>';
                html += '<td><input type="number" name="item_points['+count+']" class="form-control" value="'+num.points+'" readonly/></td>';
                html += '<td><input type="number" name="item_price['+count+']" id="price_'+count+'" class="form-control" value="'+num.price+'" readonly/></td>';
                html += '<td><input type="text" name="item_option['+count+']" class="form-control" value="'+ option +'" readonly/></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-xs remove"><i class="fas fa-trash-alt"></i></button></td>';
                html += '<tr>';
                $('#item_table tbody').append(html);

                const price = (num.price*1 + $('#credit').val()*1);
                const points = (num.points*1 + $('#points').val()*1);
                $('#credit').val(price)
                $('#price').val(price)
                $('#points').val(points)

                event.preventDefault();
            });


            $(document).on('click', '.remove', function(){
                const price = ($('#credit').val()*1 - $(this).closest('tr').find('input[name^="item_price"]').val()*1);
                const point = ($('#points').val()*1 - $(this).closest('tr').find('input[name^="item_points"]').val()*1);

                $('#credit').val(price)
                $('#price').val(price)
                $('#points').val(point)

                $(this).closest('tr').remove();
            });

            $(document).on('change', 'input[name^="item_price"]', function(){

            });
        });
    </script>
@endpush




