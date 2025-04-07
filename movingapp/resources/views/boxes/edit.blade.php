@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1>Doboz szerkesztése</h1>
        
        <form action="{{ route('boxes.update', $box) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Doboz neve *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $box->name) }}" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="max_weight">Maximum súly (kg)</label>
                <input type="number" step="0.01" class="form-control @error('max_weight') is-invalid @enderror" id="max_weight" name="max_weight" value="{{ old('max_weight', $box->max_weight) }}">
                @error('max_weight')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <small class="form-text text-muted">Maximum súly, amit a doboz elbír.</small>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="width">Szélesség (cm)</label>
                        <input type="number" step="0.01" class="form-control @error('width') is-invalid @enderror" id="width" name="width" value="{{ old('width', $box->width) }}">
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
                        <input type="number" step="0.01" class="form-control @error('length') is-invalid @enderror" id="length" name="length" value="{{ old('length', $box->length) }}">
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
                        <input type="number" step="0.01" class="form-control @error('height') is-invalid @enderror" id="height" name="height" value="{{ old('height', $box->height) }}">
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
                <a href="{{ route('boxes.show', $box) }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Mégsem
                </a>
            </div>
        </form>
    </div>
</div>
@endsection