// resources/views/boxes/index.blade.php
@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h1>Dobozok</h1>
    </div>
    <div class="col text-right">
        <a href="{{ route('boxes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Új doboz
        </a>
    </div>
</div>

@if($boxes->isEmpty())
    <div class="alert alert-info">
        Még nincs egyetlen doboz sem. Hozzon létre egy újat a "Új doboz" gombra kattintva.
    </div>
@else
    <div class="row">
        @foreach($boxes as $box)
            <div class="col-md-6 col-lg-4">
                <div class="box-container">
                    <h3>
                        <a href="{{ route('boxes.show', $box) }}">{{ $box->name }}</a>
                    </h3>
                    
                    <p class="text-muted">
                        <small>
                            <i class="fas fa-weight"></i> Súly: {{ $box->getCurrentWeight() }} / {{ $box->max_weight ?: '∞' }} kg
                            <br>
                            <i class="fas fa-cube"></i> Tárgyak: {{ $box->objects->count() }} db
                        </small>
                    </p>
                    
                    <div class="progress mb-3" style="height: 10px;">
                        @php
                            $percentage = $box->getWeightPercentage();
                            $barClass = $percentage > 90 ? 'bg-danger' : ($percentage > 75 ? 'bg-warning' : 'bg-success');
                        @endphp
                        <div class="progress-bar {{ $barClass }}" role="progressbar" style="width: {{ $percentage }}%;" 
                             aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100" 
                             title="Súly: {{ $percentage }}%"></div>
                    </div>
                    
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('boxes.show', $box) }}" class="btn btn-info">
                            <i class="fas fa-eye"></i> Részletek
                        </a>
                        <a href="{{ route('boxes.edit', $box) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Szerkesztés
                        </a>
                        <button type="button" class="btn btn-danger" 
                                onclick="if(confirm('Biztosan törölni szeretné ezt a dobozt és az összes hozzá tartozó tárgyat?')) { document.getElementById('delete-box-{{ $box->id }}').submit(); }">
                            <i class="fas fa-trash"></i> Törlés
                        </button>
                    </div>
                    
                    <form id="delete-box-{{ $box->id }}" action="{{ route('boxes.destroy', $box) }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection