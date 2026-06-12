<?php

namespace App\Http\Controllers\Partner;

use App\Enums\PartnerStatus;
use App\Enums\PropertyStatus;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    public function index()
    {
        $this->authorizePartner();
        $properties = auth()->user()->partner->properties()->latest()->get();
        return view('partner.properties.index', compact('properties'));
    }

    public function create()
    {
        $this->authorizePartner();
        return view('partner.properties.create', ['categories' => Property::CATEGORIES]);
    }

    public function store(Request $request)
    {
        $partner = $this->authorizePartner();
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name']).'-'.Str::random(6);
        $data['status'] = PropertyStatus::PENDING;
        $property = $partner->properties()->create($data);
        $this->storeImages($request, $property);
        return redirect()->route('partner.properties.index')->with('status', 'Properti dibuat dan menunggu persetujuan admin.');
    }

    public function edit(Property $property)
    {
        $this->authorizeOwner($property);
        return view('partner.properties.edit', ['property' => $property, 'categories' => Property::CATEGORIES]);
    }

    public function update(Request $request, Property $property)
    {
        $this->authorizeOwner($property);
        $data = $this->validated($request);
        $data['status'] = PropertyStatus::PENDING;
        $property->update($data);
        $this->storeImages($request, $property);
        return redirect()->route('partner.properties.index')->with('status', 'Properti diperbarui dan kembali menunggu persetujuan.');
    }

    public function destroy(Property $property)
    {
        $this->authorizeOwner($property);
        $property->delete();
        return back()->with('status', 'Properti dihapus.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', Rule::in(Property::CATEGORIES)],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:255'],
            'bedroom_count' => ['nullable', 'integer', 'min:1'],
            'bathroom_count' => ['nullable', 'integer', 'min:1'],
            'address' => ['required', 'string'],
            'price_per_night' => ['required', 'integer', 'min:1'],
            'capacity' => ['required', 'integer', 'min:1'],
            'facilities' => ['nullable', 'string'],
            'images.*' => ['nullable', 'image', 'max:2048'],
        ]);
        $data['province'] ??= $data['city'];
        $data['bedroom_count'] ??= 1;
        $data['bathroom_count'] ??= 1;
        $data['facilities'] = collect(explode(',', $data['facilities'] ?? ''))->map(fn ($v) => trim($v))->filter()->values()->all();
        return $data;
    }

    private function authorizePartner()
    {
        abort_unless(auth()->user()->role === 'partner' && auth()->user()->partner, 403);
        abort_unless(auth()->user()->partner->status === PartnerStatus::APPROVED, 403, 'Partner belum diverifikasi admin.');
        return auth()->user()->partner;
    }

    private function storeImages(Request $request, Property $property): void
    {
        foreach ($request->file('images', []) as $image) {
            PropertyImage::create([
                'property_id' => $property->id,
                'image_path' => $image->store('properties', 'public'),
            ]);
        }
    }

    private function authorizeOwner(Property $property): void
    {
        $partner = $this->authorizePartner();
        abort_unless($property->partner_id === $partner->id, 403);
    }
}
