@extends('layouts.app')

@section('title', "Editeur de Casier Judiciaire")

@section('sidebar')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('records_edit_post') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $view->id }}" name="id">
                    <div class="row">
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Matricule du Salarié (AB12345678)</label>
                                <input type="text" class="form-control" name="number" placeholder="Matricule du Salarié (AB12345678)" value="{{ $view->number }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 px-1">
                            <div class="form-group">
                                <label>Prénom du Salarié</label>
                                <input type="text" class="form-control" name="surname" placeholder="Prénom du Salarié" value="{{ $view->surname }}" required>
                            </div>
                        </div>
                        <div class="col-md-4 pl-1">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nom du Salarié</label>
                                <input type="text" class="form-control" name="name" placeholder="Nom du Salarié" value="{{ $view->name }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 pr-1">
                            <div class="form-group">
                                <label>Amende non payée (₽) (Impayé)</label>
                                @if(Session::get('grade') === 'administrator' || Session::get('grade') === 'moderator')
                                    <input type="number" class="form-control" name="credit" placeholder="Amende non payée (₽) (Impayé)" value="{{ $view->credit }}" required>
                                @else
                                    <input type="number" class="form-control" name="credit" placeholder="Amende non payée (₽) (Impayé)" value="{{ $view->credit }}" readonly>
                                @endif

                            </div>
                        </div>
                        <div class="col-md-4 pr-1">
                            <div class="form-group">
                                <label>Nom de l'agent</label>
                                @if(Session::get('grade') === 'administrator' || Session::get('grade') === 'moderator')
                                    <input type="text" class="form-control" name="name_agent" placeholder="Nom de l'agent" value="{{ $view->name_agent }}" required>
                                @else
                                    <input type="text" class="form-control" name="name_agent" placeholder="Nom de l'agent" value="{{ $view->name_agent }}" readonly>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 pl-1">
                            <div class="form-group">
                                <label>Grade de l'agent</label>
                                @if(Session::get('grade') === 'administrator' || Session::get('grade') === 'moderator')
                                    <select class="form-control" id="type" name="grade_agent" >
                                        @if(Session::get('grade') === 'administrator')
                                            <option @if($view->grade_agent === 'Colonel') selected @endif value="Colonel">Colonel</option>
                                            <option @if($view->grade_agent === 'Commandant') selected @endif value="Commandant">Commandant</option>
                                        @endif
                                        @if(Session::get('grade') === 'moderator' || Session::get('grade') === 'administrator')
                                            <option @if($view->grade_agent === 'Lieutenant') selected @endif value="Lieutenant">Lieutenant</option>
                                            <option @if($view->grade_agent === 'Maitre-principal (Major)') selected @endif value="Maitre-principal (Major)">Maitre-principal (Major)</option>
                                        @endif
                                        <option @if($view->grade_agent === 'Operator') selected @endif value="Operator">Operator</option>
                                        <option @if($view->grade_agent === 'Caporal') selected @endif value="Caporal">Caporal</option>
                                        <option @if($view->grade_agent === 'Kontraktniki') selected @endif value="Kontraktniki">Kontraktniki</option>
                                        <option @if($view->grade_agent === 'Recrue') selected @endif value="Recrue">Recrue</option>
                                    </select>
                                @else
                                    <input type="hidden" value="{{ $view->grade_agent  }}" name="grade_agent">
                                    <input type="text" class="form-control" value="{{ $view->grade_agent  }}" disabled>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea rows="4" cols="80" class="form-control" name="note" placeholder="Here can be your description">{{ $view->note }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection

