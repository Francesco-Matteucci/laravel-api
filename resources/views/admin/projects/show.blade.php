@extends('layouts.app')

@section('title', 'Dettagli Progetto')

@section('content')
<div class="container">
    <h1 class="text-light">Dettagli del Progetto: {{ $project->title }}</h1>

    <div class="card bg-dark text-light">
        <div class="card-header">{{ $project->title }}</div>
        <div class="card-body">
            <h5 class="card-title">Descrizione</h5>
            <p class="card-text">{{ $project->description }}</p>
            <p class="card-text"><strong>Tipologia:</strong> {{ $project->type ? $project->type->name : 'Nessuna tipologia associata' }}</p>

            <p class="card-text">
                <strong>Tecnologie:</strong>
                @if ($project->technologies->isEmpty())
                    <span class="text-light">Nessuna tecnologia associata</span>
                @else
                @foreach ($project->technologies as $technology)
                <span class="badge {{ 'badge-' . strtolower($technology->name) }}">{{ $technology->name }}</span>
            @endforeach
                @endif
            </p>

            <a href="{{ $project->url }}" target="_blank" class="btn btn-primary">Vai al Progetto</a>
            <hr>
            @if(Auth::check() && Auth::user()->is_admin || Auth::check() && Auth::user()->is_moderator )
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">Modifica</a>
            @endif
            @if(Auth::check() && Auth::user()->is_admin)
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Elimina</button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
