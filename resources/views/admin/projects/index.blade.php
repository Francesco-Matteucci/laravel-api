@extends('layouts.app')

@section('title', 'Gestione Progetti')

@section('content')
<div class="container">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 text-center my-4">
            <h1 class="text-light">Gestione dei Progetti</h1>
            <p class="text-light">Qui puoi visualizzare, modificare ed eliminare i progetti.</p>
        </div>

        @if(Auth::check() && Auth::user()->is_admin)
        <div class="col-md-12">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary mb-3">Crea Nuovo Progetto</a>
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary mb-3 ms-2">Gestisci Tecnologie</a>
        </div>
        @endif

        <div class="col-md-12">
            <div class="card mb-4 bg-dark text-light">
                <div class="card-header">Elenco Progetti</div>
                <div class="card-body">
                    @if($projects->isEmpty())
                        <p>Non ci sono progetti disponibili.</p>
                    @else
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titolo</th>
                                <th>Tipo</th>
                                <th>Tecnologie</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->type ? $project->type->name : 'N/A' }}</td>
                                    <td>
                                        @if ($project->technologies->isEmpty())
                                            <span class="text-light">Nessuna</span>
                                        @else
                                        @foreach ($project->technologies as $technology)
                                        <span class="badge {{ 'badge-' . strtolower($technology->name) }}">{{ $technology->name }}</span>
                                    @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-info btn-sm">Visualizza</a>
                                        @if(Auth::check() && Auth::user()->is_admin || Auth::check() && Auth::user()->is_moderator )
                                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning btn-sm">Modifica</a>
                                        @endif
                                        @if(Auth::check() && Auth::user()->is_admin)
                                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
