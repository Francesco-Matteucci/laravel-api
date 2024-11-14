@extends('layouts.app')

@section('title', 'Crea Nuova Tecnologia')

@section('content')
<div class="container">
    <h1 class="text-light">Aggiungi Nuova Tecnologia</h1>

    <form action="{{ route('admin.technologies.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label text-light">Nome della Tecnologia</label>
            <input type="text" name="name" id="name" class="form-control text-white" required>
        </div>

        <button type="submit" class="btn btn-primary">Salva Tecnologia</button>
    </form>
</div>
@endsection
