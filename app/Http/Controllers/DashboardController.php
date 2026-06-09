<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return match (auth()->user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'partner' => redirect()->route('partner.dashboard'),
            default => view('user.dashboard'),
        };
    }
}
