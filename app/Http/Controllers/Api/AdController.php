<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class AdController extends Controller
{
    public function index()
    {
        $cacheKey = 'ads_list';

        $ads = Cache::remember($cacheKey, 60, function () {
            return Ad::latest()->with('user')->get();
        });

        return response()->json($ads);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'media_type' => 'required|in:image,video',
            'media_path' => 'required|file',
            'title' => 'required|string|max:70',
            'mobile' => 'required|string|regex:/^(\+?\d{1,3}[-.\s]?)?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $file = $request->file('media_path');
        $imagePath = $file->store('images', 'public');
        $path = 'storage/' . $imagePath;

        ad::create([
            'user_id' => $request->user_id,
            'media_type' => $request->media_type,
            'media_path' => $path,
            'title' => $request->title,
            'mobile' => $request->mobile
        ]);
        Cache::forget('ads_list');

        return response()->json(['message' => 'Ads posted successfully']);
    }
    public function getUserAds($userId)
    {
        $ads = ad::with('user')->where('user_id', $userId)->paginate(10);
        return response()->json($ads);
    }
    public function destroy($id)
    {
        $ad = Ad::find($id);
        if (!$ad) {
            return response()->json(['message' => 'Ad not found'], 404);
        }
        Cache::forget('ads_list');
        $ad->delete();
        return response()->json(['message' => 'Ad deleted successfully']);
    }
}
