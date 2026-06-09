<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Booking, Ferry, Flight, Partner, Property, Review, User};

class DashboardController extends Controller
{
    public function __invoke()
    {
        abort_unless(auth()->user()->role === 'admin', 403);
        return view('admin.dashboard', [
            'counts' => [
                'users' => User::count(), 'partners' => Partner::count(), 'properties' => Property::count(),
                'bookings' => Booking::count(), 'flights' => Flight::count(), 'ferries' => Ferry::count(), 'reviews' => Review::count(),
            ],
        ]);
    }
}
