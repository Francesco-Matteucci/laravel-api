@extends('layouts.app')

@section('title', 'Modifica Progetto')

@section('content')
<div class="container">
    <h1 class="text-light">Modifica Progetto: {{ $project->title }}</h1>

    <form method="POST" action="{{ route('admin.projects.update', $project) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label text-light">Titolo</label>
            <input type="text" class="form-control text-white" id="title" name="title" value="{{ $project->title }}" required>
        </div>

        <div class="mb-3">
            <label for="type_id" class="form-label text-light">Tipo di Progetto</label>
            <select name="type_id" id="type_id" class="form-select text-white" required>
                <option value="">Seleziona un Tipo</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $project->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="technologies" class="form-label text-light">Tecnologie</label>
            <div>
                @foreach ($technologies as $technology)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="technologies[]" id="technology-{{ $technology->id }}" value="{{ $technology->id }}"
                            {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="technology-{{ $technology->id }}">{{ $technology->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label text-light">Descrizione</label>
            <textarea class="form-control text-white" id="description" name="description">{{ $project->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="url" class="form-label text-light">URL</label>
            <input type="url" class="form-control text-white" id="url" name="url" value="{{ $project->url }}">
        </div>

        <button type="submit" class="btn btn-primary">Aggiorna Progetto</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Annulla</a>
    </form>
</div>
@endsection
