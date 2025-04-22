<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetricaSesion;
use App\Models\Sesion;

class MetricaSesionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metricas = MetricaSesion::all();
        return view('metricas.index', compact('metricas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sesiones = Sesion::all(); // Obtener sesiones disponibles
        return view('metricas.create', compact('sesiones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'idSesion' => 'required|exists:sesion,idSesion',
            'metrica' => 'required|string',
            'valor' => 'required|numeric',
            'unidad' => 'required|string',
            'momento' => 'required|date',
        ]);

        MetricaSesion::create($data);

        return redirect()->route('metricas.index')->with('success', 'Métrica creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $metrica = MetricaSesion::findOrFail($id);
        return view('metricas.show', compact('metrica'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $metrica = MetricaSesion::findOrFail($id);
        $sesiones = Sesion::all();
        return view('metricas.edit', compact('metrica', 'sesiones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'idSesion' => 'required|exists:sesion,idSesion',
            'metrica' => 'required|string',
            'valor' => 'required|numeric',
            'unidad' => 'required|string',
            'momento' => 'required|date',
        ]);

        $metrica = MetricaSesion::findOrFail($id);
        $metrica->update($data);

        return redirect()->route('metricas.index')->with('success', 'Métrica actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $metrica = MetricaSesion::findOrFail($id);
        $metrica->delete();

        return redirect()->route('metricas.index')->with('success', 'Métrica eliminada correctamente.');
    }
}
