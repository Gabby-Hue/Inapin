<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Property;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $flights = $this->query($request)->paginate(15)->withQueryString();
        return view('flights.index', compact('flights'));
    }

    public function search(Request $request) { return $this->index($request); }

    public function show(Flight $flight)
    {
        $flight->load(['originAirport', 'destinationAirport']);
        $properties = Property::where('status', 'approved')->where('city', $flight->destinationAirport->city)->latest()->get();
        return view('flights.show', compact('flight', 'properties'));
    }

    private function query(Request $request)
    {
        return Flight::with(['originAirport', 'destinationAirport'])
            ->when($request->filled('origin'), fn ($q) => $q->whereHas('originAirport', fn ($a) => $a->where('city', 'like', '%'.$request->origin.'%')->orWhere('code', $request->origin)))
            ->when($request->filled('destination'), fn ($q) => $q->whereHas('destinationAirport', fn ($a) => $a->where('city', 'like', '%'.$request->destination.'%')->orWhere('code', $request->destination)))
            ->orderBy('departure_time');
    }
}
