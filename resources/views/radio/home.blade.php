@extends('layouts.app')

@section('title', 'Fréquence Radio')

@section('sidebar')
    @if(in_array(Session::get('grade'), ['administrator', 'moderator']))
        <a href="{{ route('radio_reload') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Reload Radio</a>
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card md-4">
                    <h5 class="card-header">
                        Fréquence Radio
                    </h5>
                    <div class="card-body">
                        <table class="table text-center">
                            <tbody>
                                <tr class="table">
                                    <td>
                                        Courte portée
                                    </td>
                                    <td>
                                        {{ $radios->cp }}
                                    </td>

                                </tr>
                                <tr class="table">
                                    <td>
                                        Longue portée
                                    </td>
                                    <td>
                                        {{ $radios->lp }}
                                    </td>

                                </tr>
                                <tr class="table">
                                    <td>
                                        Courte portée compromise
                                    </td>
                                    <td>
                                        {{ $radios->cp_c }}
                                    </td>

                                </tr>
                                <tr class="table">
                                    <td>
                                        Mise à Jour
                                    </td>
                                    <td>
                                        {{ $radios->updated_at }}
                                    </td>

                                </tr>
                                <tr class="table">
                                    <td>
                                        Utilisateur modifier
                                    </td>
                                    <td>
                                        {{ $radios->name_user }}
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <br>
        @if(in_array(Session::get('grade'), ['administrator', 'moderator']))
        <div class="row">
            <div class="col-md-12">
                <div class="card md-4">
                    <h5 class="card-header">
                        Editeur des Fréquence Radio
                    </h5>
                    <div class="card-body">
                        <form action="{{ route('radio_post') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="cp">Courte portée (50-400)</label>
                                <input type="number" step="0.1" min="50" max="400" class="form-control" id="cp" name="cp" placeholder="Courte portée" value="{{ $radios->cp }}">
                            </div>
                            <div class="form-group">
                                <label for="lp">Longue  portée (30-87)</label>
                                <input type="number" step="0.1" min="30" max="87" class="form-control" id="lp"  name="lp" placeholder="Longue  portée" value="{{ $radios->lp }}">
                            </div>
                            <div class="form-group">
                                <label for="cp_c">Courte portée si compromise (50-400)</label>
                                <input type="number" step="0.1" min="50" max="400" class="form-control" id="cp_c" name="cp_c" placeholder="Courte portée compromise" value="{{ $radios->cp_c }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        @endif
        </div>

@endsection
