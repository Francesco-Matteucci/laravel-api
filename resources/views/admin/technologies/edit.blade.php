@extends('layouts.app')

@section('title', 'Modifica Tecnologia')

@section('content')
<div class="container">
    <h1 class="text-light">Modifica Tecnologia</h1>

    <form action="{{ route('admin.technologies.update', $technology) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label text-light">Nome</label>
            <input type="text" class="form-control text-white" id="name" name="name" value="{{ old('name', $technology->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Aggiorna Tecnologia</button>
        <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary">Annulla</a>
    </form>
</div>
@endsection
