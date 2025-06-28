<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Método index con Request para poder leer los filtros
    public function index(Request $request)
    {
        $query = Auth::user()->reservas()->orderBy('fecha', 'desc');

        if ($request->filled('fecha')) {
            $query->where('fecha', $request->fecha);
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $reservas = $query->get();

        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        return view('reservas.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'servicio.required' => 'El servicio es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.after_or_equal' => 'La fecha debe ser hoy o posterior.',
            'hora.required' => 'La hora es obligatoria.',
        ];

        $request->validate([
            'servicio' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
        ], $messages);

        $reserva = Auth::user()->reservas()->create([
            'servicio' => $request->servicio,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'estado' => 'pendiente', // Se fuerza a 'pendiente'
        ]);

        // Notificar al usuario de la creación (asegúrate de tener esta notificación creada)
        Auth::user()->notify(new \App\Notifications\ReservaCreada($reserva));

        return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente.');
    }

    public function edit(Reserva $reserva)
    {
        $this->authorize('update', $reserva);
        return view('reservas.edit', compact('reserva'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $this->authorize('update', $reserva);

        $request->validate([
            'servicio' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
        ]);

        $data = $request->only('servicio', 'fecha', 'hora');

        // Solo el admin puede cambiar el estado
        if (auth()->user()->email === 'marielysilva1389@gmail.com') {
            $data['estado'] = $request->estado;
        }

        $reserva->update($data);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente.');
    }

    public function destroy(Reserva $reserva)
    {
        $this->authorize('delete', $reserva);
        $reserva->delete();

        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada.');
    }
}