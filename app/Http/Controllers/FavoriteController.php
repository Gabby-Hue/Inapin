<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::with('property')->where('user_id', auth()->id())->latest('created_at')->get();
        return view('user.favorites', compact('favorites'));
    }

    public function store(Request $request)
    {
        $data = $request->validate(['property_id' => ['required', 'exists:properties,id']]);
        Favorite::firstOrCreate(['user_id' => auth()->id(), 'property_id' => $data['property_id']], ['created_at' => now()]);
        return back()->with('status', 'Properti ditambahkan ke favorit.');
    }

    public function destroy(Favorite $favorite)
    {
        abort_unless($favorite->user_id === auth()->id(), 403);
        $favorite->delete();
        return back()->with('status', 'Favorit dihapus.');
    }
}
