<?php

namespace App\Http\Controllers;

use App\Models\FeaturedTour;
use Illuminate\Http\Request;

class FeaturedTourController extends Controller
{
    /**
     * Display a listing of featured tours.
     */
    public function index()
    {
        $tours = FeaturedTour::where('is_active', true)
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tours
        ]);
    }

    /**
     * Display the specified featured tour.
     */
    public function show(FeaturedTour $featuredTour)
    {
        return response()->json([
            'success' => true,
            'data' => $featuredTour
        ]);
    }

    /**
     * Store a newly created featured tour in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'required|string',
            'order' => 'integer|default:0',
            'is_active' => 'boolean|default:true'
        ]);

        $tour = FeaturedTour::create($validated);

        return response()->json([
            'success' => true,
            'data' => $tour
        ], 201);
    }

    /**
     * Update the specified featured tour in storage.
     */
    public function update(Request $request, FeaturedTour $featuredTour)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'image_path' => 'string',
            'order' => 'integer',
            'is_active' => 'boolean'
        ]);

        $featuredTour->update($validated);

        return response()->json([
            'success' => true,
            'data' => $featuredTour
        ]);
    }

    /**
     * Remove the specified featured tour from storage.
     */
    public function destroy(FeaturedTour $featuredTour)
    {
        $featuredTour->delete();

        return response()->json([
            'success' => true,
            'message' => 'Featured tour deleted successfully'
        ]);
    }
}
