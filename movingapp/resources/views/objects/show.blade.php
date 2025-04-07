// resources/views/objects/show.blade.php
@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h1>{{ $object->name }}</h1>
        <p class="text-muted">
            <strong>Doboz:</strong> <a href="{{ route('boxes.show', $object->box) }}">{{ $object->box->name }}</a>
        </p>
    </div>
    <div class="col text-right">
        <div class="btn-group">
            <a href="{{ route('objects.edit', $object) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Szerkesztés
            </a>
            <button type="button" class="btn btn-danger" 
                    onclick="if(confirm('Biztosan törölni szeretné ezt a tárgyat?')) { document.getElementById('delete-object').submit(); }">
                <i class="fas fa-trash"></i> Törlés
            </button>
        </div>
        
        <form id="delete-object" action="{{ route('objects.destroy', $object) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Tárgy részletei</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Súly:</strong> {{ $object->weight ? $object->weight . ' kg' : 'Nincs megadva' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Méret:</strong>
                {{ $object->width && $object->length && $object->height 
                   ? $object->width . ' × ' . $object->length . ' × ' . $object->height . ' cm' 
                   : 'Nincs megadva' }}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('objects.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Vissza a tárgyakhoz
    </a>
    <a href="{{ route('boxes.show', $object->box) }}" class="btn btn-info">
        <i class="fas fa-box"></i> Ugrás a dobozhoz
    </a>
</div>
@endsection