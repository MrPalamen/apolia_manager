@extends('layouts.app')

@section('title', "Barème d'Amende")

@section('sidebar')

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card md-4">
            <div class="card-body">
                <form action="{{ route('fine_scales_edit_post') }}" method="post">
                    @csrf
                    <input type="hidden" value="{{ $view->id }}" name="id">
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option @if($view->type === 'Route') selected @endif value="Route">Route</option>
                            <option @if($view->type === 'Vol') selected @endif value="Vol">Vol</option>
                            <option @if($view->type === 'Ordre public') selected @endif value="Ordre public">Ordre public</option>
                            <option @if($view->type === 'Armement') selected @endif value="Armement">Armement</option>
                            <option @if($view->type === 'Délits majeur') selected @endif value="Délits majeur">Délits majeur</option>
                            <option @if($view->type === 'Stupéfiant') selected @endif value="Stupéfiant">Stupéfiant</option>
                            <option @if($view->type === 'Marché Noir') selected @endif value="Marché Noir">Marché Noir</option>
                            <option @if($view->type === '.') selected @endif value=".">.</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Nom de Amende</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nom de Amende" value="{{ $view->name }}" required >
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <label for="point">Retrait Point(s)</label>
                                <input type="number" name="point" id="point" class="form-control" placeholder="Retrait Point(s)" value="{{ $view->points }}" required>
                            </div>
                            <div class="col">
                                <label for="price">Prix de l'Amende (₽)</label>
                                <input type="number" name="price" id="price" class="form-control" placeholder="Prix de l'Amende (₽)" value="{{ $view->price }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="option">Option</label>
                        <textarea class="form-control" name="option" id="option" placeholder="Option" rows="10" >{{ $view->option }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

