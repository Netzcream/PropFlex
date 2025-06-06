<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $featured = Property::where('is_published', true)
            ->where('is_featured', true)
            ->inRandomOrder()
            ->take(3)
            ->get();


        $recentIds = array_unique(array_reverse(session('recently_viewed', [])));
        $recent = Property::whereIn('id', $recentIds)->get()->keyBy('id');
        // Así mantenés el orden de la sesión
        $recentOrdered = collect($recentIds)->map(fn($id) => $recent[$id])->filter();

        return view('home', [
            'featured' => $featured,
            'recent' => $recentOrdered,
        ]);
    }
}
