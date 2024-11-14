@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center my-4">
        <div class="col-md-8 text-center">
            <h1 class="text-light">Benvenuto nel Portfolio</h1>
            <p class="text-light">Qui puoi visualizzare i progetti e le statistiche. Iscriviti per portare il tutto ad un livello superiore!</p>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <div class="card bg-dark text-light">
                <div class="card-header text-center">Statistiche</div>
                <div class="card-body">
                    <p>Numero Totale di Progetti: {{ $projects->count() }}</p>
                    <p>Numero Totale di Tipologie presenti: {{ $types->count() }}</p>
                    <p>Numero Totale di Tecnologie utilizzate: {{ $technologies->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark text-light">
                <div class="card-header text-center">Progetti Recenti</div>
                <div class="card-body">
                    @if($projects->isEmpty())
                        <p>Non ci sono progetti recenti.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($projects as $project)
                                <li class="list-group-item bg-secondary text-light mb-3">
                                    <h5>{{ $project->title }}</h5>
                                    <p>{{ $project->description }}</p>

                                    <p><strong>Tipologia:</strong> {{ $project->type ? $project->type->name : 'Nessuna tipologia associata' }}</p>

                                    @if ($project->technologies->isNotEmpty())
                                        <p><strong>Tecnologie:</strong>
                                            @foreach ($project->technologies as $technology)
                                                <span class="badge {{ 'badge-' . strtolower($technology->name) }}">{{ $technology->name }}</span>
                                            @endforeach
                                        </p>
                                    @else
                                        <p><strong>Tecnologie:</strong> Nessuna</p>
                                    @endif

                                    <a href="{{ $project->url }}" target="_blank" class="btn btn-primary mt-2">Vai al Progetto</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
