<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GalleryItemController extends Controller
{
    /**
     * Display a listing of active gallery items.
     */
    public function index(Request $request)
    {
        $query = GalleryItem::where('is_active', true)
            ->with('category')
            ->orderBy('order');

        // Filter by category if provided
        if ($request->has('category_id')) {
            $query->where('gallery_category_id', $request->category_id);
        }

        $items = $query->get();

        return response()->json([
            'success' => true,
            'data' => $items
        ]);
    }

    /**
     * Store a newly created gallery item in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('image');

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
            $data['image_path'] = $imagePath;
        }

        $item = GalleryItem::create($data);
        $item->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Gallery item created successfully',
            'data' => $item
        ], 201);
    }

    /**
     * Display the specified gallery item.
     */
    public function show(GalleryItem $galleryItem)
    {
        $galleryItem->load('category');

        return response()->json([
            'success' => true,
            'data' => $galleryItem
        ]);
    }

    /**
     * Update the specified gallery item in storage.
     */
    public function update(Request $request, GalleryItem $galleryItem)
    {
        $validator = Validator::make($request->all(), [
            'gallery_category_id' => 'nullable|exists:gallery_categories,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->except('image');

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete old image
            if ($galleryItem->image_path) {
                Storage::disk('public')->delete($galleryItem->image_path);
            }
            
            $imagePath = $request->file('image')->store('gallery', 'public');
            $data['image_path'] = $imagePath;
        }

        $galleryItem->update($data);
        $galleryItem->load('category');

        return response()->json([
            'success' => true,
            'message' => 'Gallery item updated successfully',
            'data' => $galleryItem
        ]);
    }

    /**
     * Remove the specified gallery item from storage.
     */
    public function destroy(GalleryItem $galleryItem)
    {
        // Delete image file
        if ($galleryItem->image_path) {
            Storage::disk('public')->delete($galleryItem->image_path);
        }

        $galleryItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Gallery item deleted successfully'
        ]);
    }
}
