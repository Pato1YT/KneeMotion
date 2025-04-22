@extends('layouts.app')

@section('content')
    <h1>Crear Métrica</h1>

    <form action="{{ route('metricas.store') }}" method="POST">
        @csrf
        <label for="idSesion">Sesión:</label>
        <select name="idSesion" required>
            @foreach ($sesiones as $sesion)
                <option value="{{ $sesion->idSesion }}">{{ $sesion->idSesion }}</option>
            @endforeach
        </select>

        <label for="metrica">Métrica:</label>
        <input type="text" name="metrica" required>

        <label for="valor">Valor:</label>
        <input type="number" name="valor" required>

        <label for="unidad">Unidad:</label>
        <input type="text" name="unidad" required>

        <label for="momento">Momento:</label>
        <input type="datetime-local" name="momento" required>

        <button type="submit">Guardar Métrica</button>
    </form>
@endsection
