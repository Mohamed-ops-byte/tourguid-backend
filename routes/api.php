<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryCategoryController;
use App\Http\Controllers\GalleryItemController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\FeaturedTourController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\OwnerInfoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{service}', [ServiceController::class, 'show']);

Route::get('/gallery-categories', [GalleryCategoryController::class, 'index']);
Route::get('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'show']);

Route::get('/gallery-items', [GalleryItemController::class, 'index']);
Route::get('/gallery-items/{galleryItem}', [GalleryItemController::class, 'show']);

Route::get('/videos', [VideoController::class, 'index']);
Route::get('/videos/{video}', [VideoController::class, 'show']);

Route::post('/contact-messages', [ContactMessageController::class, 'store']);

Route::get('/featured-tours', [FeaturedTourController::class, 'index']);
Route::get('/featured-tours/{featuredTour}', [FeaturedTourController::class, 'show']);

// Owner info (public)
Route::get('/owner-info', [OwnerInfoController::class, 'index']);

// Auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all-devices', [AuthController::class, 'logoutAllDevices']);
    Route::delete('/user/account', [AuthController::class, 'deleteAccount']);
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user()
        ]);
    });

    // Services management
    Route::post('/services', [ServiceController::class, 'store']);
    Route::put('/services/{service}', [ServiceController::class, 'update']);
    Route::delete('/services/{service}', [ServiceController::class, 'destroy']);

    // Gallery categories management
    Route::post('/gallery-categories', [GalleryCategoryController::class, 'store']);
    Route::put('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'update']);
    Route::delete('/gallery-categories/{galleryCategory}', [GalleryCategoryController::class, 'destroy']);

    // Gallery items management
    Route::post('/gallery-items', [GalleryItemController::class, 'store']);
    Route::post('/gallery-items/{galleryItem}', [GalleryItemController::class, 'update']);
    Route::delete('/gallery-items/{galleryItem}', [GalleryItemController::class, 'destroy']);

    // Videos management
    Route::post('/videos', [VideoController::class, 'store']);
    Route::put('/videos/{video}', [VideoController::class, 'update']);
    Route::delete('/videos/{video}', [VideoController::class, 'destroy']);

    // Featured tours management
    Route::post('/featured-tours', [FeaturedTourController::class, 'store']);
    Route::put('/featured-tours/{featuredTour}', [FeaturedTourController::class, 'update']);
    Route::delete('/featured-tours/{featuredTour}', [FeaturedTourController::class, 'destroy']);

    // Contact messages management
    Route::get('/contact-messages', [ContactMessageController::class, 'index']);
    Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show']);
    Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy']);

    // Owner info management
    Route::post('/owner-info', [OwnerInfoController::class, 'update']);
});
