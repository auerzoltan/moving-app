// resources/views/objects/index.blade.php
@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h1>Tárgyak</h1>
    </div>
    <div class="col text-right">
        <a href="{{ route('objects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Új tárgy
        </a>
    </div>
</div>

@if($objects->isEmpty())
    <div class="alert alert-info">
        Még nincs egyetlen tárgy sem. Hozzon létre egy újat a "Új tárgy" gombra kattintva.
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
                        <td>
                            <a href="{{ route('boxes.show', $object->box) }}">
                                {{ $object->box->name }}
                            </a>
                        </td>
                        <td>{{ $object->weight ? $object->weight . ' kg' : '-' }}</td>
                        <td>
                            {{ $object->width && $object->length && $object->height 
                               ? $object->width . ' × ' . $object->length . ' × ' . $object->height . ' cm' 
                               : '-' }}
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('objects.show', $object) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('objects.edit', $object) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger" 
                                        onclick="if(confirm('Biztosan törölni szeretné ezt a tárgyat?')) { document.getElementById('delete-object-{{ $object->id }}').submit(); }">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                            
                            <form id="delete-object-{{ $object->id }}" action="{{ route('objects.destroy', $object) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection