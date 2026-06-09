<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('property')->where('user_id', auth()->id())->latest()->get();
        return view('user.bookings', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        abort_unless($booking->user_id === auth()->id() || optional(auth()->user())->role === 'admin', 403);
        return view('bookings.show', ['booking' => $booking->load('property')]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'check_in' => ['required', 'date'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guest_count' => ['required', 'integer', 'min:1'],
        ]);

        $property = Property::findOrFail($data['property_id']);
        abort_unless($property->status === 'approved', 403, 'Properti belum disetujui.');
        abort_if((int) $data['guest_count'] > $property->capacity, 422, 'Jumlah tamu melebihi kapasitas properti.');

        $nights = Carbon::parse($data['check_in'])->diffInDays(Carbon::parse($data['check_out']));
        $booking = Booking::create($data + [
            'user_id' => auth()->id(),
            'total_price' => (int) $nights * $property->price_per_night,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.show', $booking)->with('status', 'Booking berhasil dibuat.');
    }

    public function update(Request $request, Booking $booking)
    {
        abort_unless($booking->user_id === auth()->id() || optional(auth()->user())->role === 'admin', 403);
        $data = $request->validate(['status' => ['required', 'in:pending,confirmed,completed,cancelled']]);
        if (auth()->user()->role === 'user') {
            abort_unless($data['status'] === 'cancelled', 403);
        }
        $booking->update($data);
        return back()->with('status', 'Status booking diperbarui.');
    }
}
