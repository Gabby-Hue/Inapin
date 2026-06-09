<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Partner, Property, Review, User};
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    private function admin(): void { abort_unless(auth()->user()->role === 'admin', 403); }

    public function users() { $this->admin(); return view('admin.users', ['users' => User::latest()->get()]); }
    public function partners() { $this->admin(); return view('admin.partners', ['partners' => Partner::with('user')->latest()->get()]); }
    public function properties() { $this->admin(); return view('admin.properties', ['properties' => Property::with('partner.user')->latest()->get()]); }
    public function reviews() { $this->admin(); return view('admin.reviews', ['reviews' => Review::with(['property', 'user'])->latest()->get()]); }

    public function updatePartner(Request $request, Partner $partner)
    {
        $this->admin();
        $data = $request->validate(['verification_status' => ['required', 'in:pending,approved,rejected']]);
        $partner->update($data);
        return back()->with('status', 'Status partner diperbarui.');
    }

    public function updateProperty(Request $request, Property $property)
    {
        $this->admin();
        $data = $request->validate(['status' => ['required', 'in:pending,approved,rejected']]);
        $property->update($data);
        return back()->with('status', 'Status properti diperbarui.');
    }

    public function destroyReview(Review $review)
    {
        $this->admin();
        $review->delete();
        return back()->with('status', 'Review dihapus.');
    }
}
