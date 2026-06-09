<?php

namespace App\Http\Controllers;

use App\Models\Ferry;
use App\Models\Property;
use Illuminate\Http\Request;

class FerryController extends Controller
{
    public function index(Request $request)
    {
        $ferries = Ferry::with(['originPort', 'destinationPort'])
            ->when($request->filled('origin'), fn ($q) => $q->whereHas('originPort', fn ($p) => $p->where('city', 'like', '%'.$request->origin.'%')->orWhere('name', 'like', '%'.$request->origin.'%')))
            ->when($request->filled('destination'), fn ($q) => $q->whereHas('destinationPort', fn ($p) => $p->where('city', 'like', '%'.$request->destination.'%')->orWhere('name', 'like', '%'.$request->destination.'%')))
            ->orderBy('departure_time')->paginate(15)->withQueryString();
        return view('ferries.index', compact('ferries'));
    }

    public function search(Request $request) { return $this->index($request); }

    public function show(Ferry $ferry)
    {
        $ferry->load(['originPort', 'destinationPort']);
        $properties = Property::where('status', 'approved')->where('city', $ferry->destinationPort->city)->latest()->get();
        return view('ferries.show', compact('ferry', 'properties'));
    }
}
