<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $properties = Property::with('reviews')
            ->where('status', 'approved')
            ->when($request->filled('city'), fn ($q) => $q->where('city', 'like', '%'.$request->city.'%'))
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->category))
            ->latest()->paginate(12)->withQueryString();

        return view('properties.index', ['properties' => $properties, 'categories' => Property::CATEGORIES]);
    }

    public function show(Property $property)
    {
        abort_unless($property->status === 'approved' || optional(auth()->user())->role === 'admin', 404);
        return view('properties.show', ['property' => $property->load(['reviews.user', 'partner.user'])]);
    }

    public function recommendations(Request $request)
    {
        $data = $request->validate(['city' => ['required', 'string']]);
        $properties = Property::where('status', 'approved')->where('city', $data['city'])->latest()->get();
        return view('properties.recommendations', compact('properties', 'data'));
    }
}
