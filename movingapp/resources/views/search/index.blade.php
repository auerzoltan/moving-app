// resources/views/search/index.blade.php
@extends('layouts.app')

@section('content')
<h1>Keresés</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('search.results') }}" method="GET">
            <div class="form-group">
                <label for="query">Keresési kifejezés</label>
                <input type="text" class="form-control" id="query" name="query" placeholder="Írja be a keresési kifejezést..." required>
            </div>
            
            <div class="form-group">
                <label>Keresés típusa</label>
                <div class="custom-control custom-radio">
                    <input type="radio" id="type_object" name="type" value="object" class="custom-control-input" checked>
                    <label class="custom-control-label" for="type_object">Tárgy keresése</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="type_box" name="type" value="box" class="custom-control-input">
                    <label class="custom-control-label" for="type_box">Doboz keresése</label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Keresés
            </button>
        </form>
    </div>
</div>
@endsection