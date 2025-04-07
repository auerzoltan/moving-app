// resources/views/boxes/show.blade.php
@extends('layouts.app')

@section('content')
<div class="row mb-3">
    <div class="col">
        <h1>{{ $box->name }}</h1>
        <p class="text-muted">
            <i class="fas fa-weight"></i> Maximum súly: {{ $box->max_weight ? $box->max_weight . ' kg' : 'Nincs megadva' }} | 
            <i class="fas fa-ruler-combined"></i> Méret: 
            {{ $box->width && $box->length && $box->height 
               ? $box->width . ' × ' . $box->length . ' × ' . $box->height . ' cm' 
               : 'Nincs megadva' }}
        </p>
    </div>
    <div class="col text-right">
        <div class="btn-group">
            <a href="{{ route('boxes.edit', $box) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Szerkesztés
            </a>
            <button type="button" class="btn btn-danger" 
                    onclick="if(confirm('Biztosan törölni szeretné ezt a dobozt és az összes hozzá tartozó tárgyat?')) { document.getElementById('delete-box').submit(); }">
                <i class="fas fa-trash"></i> Törlés
            </button>
        </div>
        
        <form id="delete-box" action="{{ route('boxes.destroy', $box) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<!-- Súly és térfogat kihasználtság -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Kihasználtság</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h6>Súly: {{ $box->getCurrentWeight() }} / {{ $box->max_weight ?: '∞' }} kg</h6>
                <div class="progress mb-3" style="height: 20px;">
                    @php
                        $weightPercentage = $box->getWeightPercentage();
                        $weightBarClass = $weightPercentage > 90 ? 'bg-danger' : ($weightPercentage > 75 ? 'bg-warning' : 'bg-success');
                    @endphp
                    <div class="progress-bar {{ $weightBarClass }}" role="progressbar" 
                         style="width: {{ $weightPercentage }}%;" 
                         aria-valuenow="{{ $weightPercentage }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $weightPercentage }}%
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h6>Térfogat</h6>
                <div class="progress mb-3" style="height: 20px;">
                    @php
                        $volumePercentage = $box->getVolumePercentage();
                        $volumeBarClass = $volumePercentage > 90 ? 'bg-danger' : ($volumePercentage > 75 ? 'bg-warning' : 'bg-success');
                    @endphp
                    <div class="progress-bar {{ $volumeBarClass }}" role="progressbar" 
                         style="width: {{ $volumePercentage }}%;" 
                         aria-valuenow="{{ $volumePercentage }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $volumePercentage }}%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tárgyak listája -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Tárgyak a dobozban ({{ $objects->count() }} db)</h5>
        <a href="{{ route('objects.create', ['box_id' => $box->id]) }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Új tárgy
        </a>
    </div>
    <div class="card-body">
        @if($objects->isEmpty())
            <div class="alert alert-info">
                Még nincs tárgy ebben a dobozban. Adjon hozzá tárgyakat a "Új tárgy" gombra kattintva.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>Súly</th>
                            <th>Méret</th>
                            <th>Műveletek</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($objects as $object)
                            <tr>
                                <td>{{ $object->name }}</td>
                                <td>{{ $object->weight ? $object->weight . ' kg' : '-' }}</td>
                                <td>
                                    {{ $object->width && $object->length && $object->height 
                                       ? $object->width . ' × ' . $object->length . ' × ' . $object->height . ' cm' 
                                       : '-' }}
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
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
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('boxes.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Vissza a dobozokhoz
    </a>
</div>
@endsection