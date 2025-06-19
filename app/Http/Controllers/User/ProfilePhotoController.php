<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ProfilePhotoController extends Controller
{
    public function update(Request $request)
{
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    try {
        if ($request->hasFile('profile_photo')) {
            $user = auth()->user();
            
            if ($user->profile_photo) {
                Storage::disk('public')->delete('profile-photos/' . $user->profile_photo);
            }
            
            $photoName = time() . '_' . uniqid() . '.' . $request->profile_photo->extension();
            $request->profile_photo->storeAs('profile-photos', $photoName, 'public');
            
            $user->profile_photo = $photoName;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile photo updated successfully',
                'photo_url' => $user->profile_photo_url
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No photo uploaded'
        ], 400);
    } catch (\Exception $e) {
        \Log::error('Photo upload error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Upload failed: ' . $e->getMessage()
        ], 500);
    }
}

    public function show($filename)
    {
        $path = 'profile-photos/' . $filename;
        
        if (!Storage::disk('local')->exists($path)) {
            abort(404);
        }
        
        return response()->file(storage_path('app/' . $path));
    }
}