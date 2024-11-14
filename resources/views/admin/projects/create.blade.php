@extends('layouts.app')

@section('title', 'Crea Nuovo Progetto')

@section('content')
<div class="container">
    <h1 class="text-light">Crea un Nuovo Progetto</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label text-light">Titolo</label>
            <input type="text" name="title" id="title" class="form-control text-white" required>
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label text-light">Tipo di Progetto</label>
            <select name="type_id" id="type_id" class="form-select text-white" required>
                <option value="">Seleziona un Tipo</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tecnologie</label>
            @foreach ($technologies as $technology)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="technologies[]" value="{{ $technology->id }}" id="technology-{{ $technology->id }}"
                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="description" class="form-label text-light">Descrizione</label>
            <textarea name="description" id="description" class="form-control text-white" rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label text-light">URL</label>
            <input type="url" name="url" id="url" class="form-control text-white">
        </div>


        <button type="submit" class="btn btn-primary">Salva Progetto</button>
    </form>
</div>
@endsection
