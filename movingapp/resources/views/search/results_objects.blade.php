// resources/views/search/results_objects.blade.php
@extends('layouts.app')

@section('content')
<h1>Keresési eredmények</h1>
<p>A(z) "<strong>{{ $query }}</strong>" kifejezésre a következő tárgyakat találtam:</p>

<div class="mb-3">
    <a href="{{ route('search.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Vissza a kereséshez
    </a>
</div>

@if($objects->isEmpty())
    <div class="alert alert-info">
        Nem találtam a keresési feltételnek megfelelő tárgyat.
    </div>
@else
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Név</th>
                    <th>Doboz</th>
                    <th>Súly</th>
                    <th>Méret</th>
                    <th>Műveletek</th>
                </tr>
                </thead>
            <tbody>
                @foreach($objects as $object)
                    <tr>
                        <td>{{ $object->name }}</td>
                        <td>{{ $object->box }}</td>
                        <td>{{ $object->weight }}</td>
                        <td>{{ $object->size }}</td>
                        <td>
                            <a href="{{ route('objects.show', $object->id) }}" class="btn btn-info btn-sm">Megtekintés</a>
                            <a href="{{ route('objects.edit', $object->id) }}" class="btn btn-warning btn-sm">Szerkesztés</a>
                            <form action="{{ route('objects.destroy', $object->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection