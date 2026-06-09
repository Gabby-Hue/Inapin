<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id' => ['required', 'exists:bookings,id', 'unique:reviews,booking_id'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string'],
        ]);
        $booking = Booking::findOrFail($data['booking_id']);
        abort_unless($booking->user_id === auth()->id(), 403);
        abort_unless($booking->status === 'completed', 403, 'Review hanya untuk stay yang selesai.');
        Review::create($data + ['property_id' => $booking->property_id, 'user_id' => auth()->id()]);
        return redirect()->route('properties.show', $booking->property)->with('status', 'Review berhasil dikirim.');
    }

    public function propertyReviews(int $id)
    {
        return Review::with('user')->where('property_id', $id)->latest()->get();
    }
}
