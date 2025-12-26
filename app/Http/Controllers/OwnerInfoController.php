<?php

namespace App\Http\Controllers;

use App\Models\OwnerInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OwnerInfoController extends Controller
{
    /**
     * Get owner info (public access)
     */
    public function index()
    {
        $ownerInfo = OwnerInfo::first();
        
        if (!$ownerInfo) {
            return response()->json([
                'success' => false,
                'message' => 'Owner info not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ownerInfo,
        ]);
    }

    /**
     * Update owner info (requires authentication)
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'bio_ar' => 'nullable|string',
            'bio_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'years_experience' => 'nullable|integer|min:0',
            'tours_completed' => 'nullable|integer|min:0',
            'happy_clients' => 'nullable|integer|min:0',
            'average_rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $ownerInfo = OwnerInfo::firstOrFail();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($ownerInfo->image_url && Storage::disk('public')->exists($ownerInfo->image_url)) {
                Storage::disk('public')->delete($ownerInfo->image_url);
            }

            // Store new image
            $imagePath = $request->file('image')->store('owner', 'public');
            $ownerInfo->image_url = $imagePath;
        }

        // Update other fields
        $ownerInfo->name = $request->input('name');
        $ownerInfo->title = $request->input('title');
        $ownerInfo->bio_ar = $request->input('bio_ar');
        $ownerInfo->bio_en = $request->input('bio_en');
        
        if ($request->has('years_experience')) {
            $ownerInfo->years_experience = $request->input('years_experience');
        }
        if ($request->has('tours_completed')) {
            $ownerInfo->tours_completed = $request->input('tours_completed');
        }
        if ($request->has('happy_clients')) {
            $ownerInfo->happy_clients = $request->input('happy_clients');
        }
        if ($request->has('average_rating')) {
            $ownerInfo->average_rating = $request->input('average_rating');
        }

        $ownerInfo->save();

        return response()->json([
            'success' => true,
            'message' => 'Owner info updated successfully',
            'data' => $ownerInfo,
        ]);
    }
}
