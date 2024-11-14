@extends('layouts.app')

@section('title', 'Gestione Tecnologie')

@section('content')
<div class="container">
    <h1 class="text-light">Gestione delle Tecnologie</h1>
    <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary my-3">Aggiungi Nuova Tecnologia</a>

    <div class="card bg-dark text-light">
        <div class="card-header">Elenco Tecnologie</div>
        <div class="card-body">
            @if($technologies->isEmpty())
                <p>Nessuna tecnologia disponibile.</p>
            @else
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technologies as $technology)
                            <tr>
                                <td>{{ $technology->id }}</td>
                                <td>{{ $technology->name }}</td>
                                <td>
                                    <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-warning btn-sm">Modifica</a>
                                    <form action="{{ route('admin.technologies.destroy', $technology) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
