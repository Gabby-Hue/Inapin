<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __invoke()
    {
        abort_unless(auth()->user()->role === 'partner', 403);
        $partner = auth()->user()->partner;
        return view('partner.dashboard', ['partner' => $partner, 'properties' => $partner?->properties()->withCount('bookings')->get() ?? collect()]);
    }
}
