// resources/views/objects/create.blade.php
@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1>Új tárgy létrehozása</h1>
        
        @if($boxes->isEmpty())
            <div class="alert alert-warning">
                Nincs még doboz. Először <a href="{{ route('boxes.create') }}">hozzon létre egy dobozt</a>, mielőtt tárgyat adna hozzá.
            </div>
        @else
            <form action="{{ route('objects.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="box_id">Doboz *</label>
                    <select class="form-control @error('box_id') is-invalid @enderror" id="box_id" name="box_id" required>
                        <option value="">-- Válasszon dobozt --</option>
                        @foreach($boxes as $box)
                            <option value="{{ $box->id }}" {{ old('box_id', request('box_id')) == $box->id ? 'selected' : '' }}>
                                {{ $box->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('box_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="name">Tárgy neve *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="weight">Súly (kg)</label>
                    <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight') }}">
                    @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="width">Szélesség (cm)</label>
                            <input type="number" step="0.01" class="form-control @error('width') is-invalid @enderror" id="width" name="width" value="{{ old('width') }}">
                            @error('width')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="length">Hosszúság (cm)</label>
                            <input type="number" step="0.01" class="form-control @error('length') is-invalid @enderror" id="length" name="length" value="{{ old('length') }}">
                            @error('length')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="height">Magasság (cm)</label>
                            <input type="number" step="0.01" class="form-control @error('height') is-invalid @enderror" id="height" name="height" value="{{ old('height') }}">
                            @error('height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mentés
                    </button>
                    <a href="{{ route('objects.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Mégsem
                    </a>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection