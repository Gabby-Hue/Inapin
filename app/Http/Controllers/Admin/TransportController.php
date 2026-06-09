<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Airport, Ferry, Flight, Port};
use Illuminate\Http\Request;

class TransportController extends Controller
{
    private function admin(): void { abort_unless(auth()->user()->role === 'admin', 403); }

    public function flights() { $this->admin(); return view('admin.flights', ['flights' => Flight::with(['originAirport', 'destinationAirport'])->latest()->get(), 'airports' => Airport::orderBy('city')->get()]); }
    public function ferries() { $this->admin(); return view('admin.ferries', ['ferries' => Ferry::with(['originPort', 'destinationPort'])->latest()->get(), 'ports' => Port::orderBy('city')->get()]); }

    public function storeAirport(Request $request)
    {
        $this->admin();
        Airport::create($request->validate(['name' => ['required'], 'city' => ['required'], 'code' => ['required', 'unique:airports,code']]));
        return back()->with('status', 'Bandara dibuat.');
    }

    public function storeFlight(Request $request)
    {
        $this->admin();
        Flight::create($request->validate([
            'airline' => ['required'], 'origin_airport_id' => ['required', 'exists:airports,id'], 'destination_airport_id' => ['required', 'exists:airports,id'],
            'departure_time' => ['required', 'date'], 'arrival_time' => ['required', 'date', 'after:departure_time'], 'price' => ['required', 'integer', 'min:1'],
        ]));
        return back()->with('status', 'Penerbangan dibuat.');
    }

    public function storePort(Request $request)
    {
        $this->admin();
        Port::create($request->validate(['name' => ['required'], 'city' => ['required']]));
        return back()->with('status', 'Pelabuhan dibuat.');
    }

    public function storeFerry(Request $request)
    {
        $this->admin();
        Ferry::create($request->validate([
            'operator' => ['required'], 'origin_port_id' => ['required', 'exists:ports,id'], 'destination_port_id' => ['required', 'exists:ports,id'],
            'departure_time' => ['required', 'date'], 'arrival_time' => ['required', 'date', 'after:departure_time'], 'price' => ['required', 'integer', 'min:1'],
        ]));
        return back()->with('status', 'Jadwal kapal dibuat.');
    }
}
