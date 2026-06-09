<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->role === 'partner', 403);
        $bookings = Booking::with(['property', 'user'])->whereHas('property', fn ($q) => $q->where('partner_id', auth()->user()->partner->id))->latest()->get();
        return view('partner.bookings.index', compact('bookings'));
    }

    public function update(Request $request, Booking $booking)
    {
        abort_unless(auth()->user()->role === 'partner' && $booking->property->partner_id === auth()->user()->partner->id, 403);
        $data = $request->validate(['status' => ['required', 'in:pending,confirmed,completed,cancelled']]);
        $booking->update($data);
        return back()->with('status', 'Status booking diperbarui.');
    }
}
