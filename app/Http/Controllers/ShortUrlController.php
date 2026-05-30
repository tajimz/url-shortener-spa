<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    //

    function index(Request $request)
    {
        return response()->json([
            'data' => $request->user()->shortUrls()->latest()->get()
        ]);
    }
    function store(Request $request)
    {
        $validated = $request->validate([
            'long_url' => 'required|url',
            'short_code' => 'nullable|min:3|max:10|unique:short_urls,short_code',
        ]);

        $shortCode = $validated['short_code'] ?? Str::random(6);

        $shortUrl = $request->user()->shortUrls()->create([
            'long_url' => $validated['long_url'],
            'short_code' => $shortCode,
        ]);

        return response()->json([
            'message' => 'URL shortened successfully',
            'data' => $shortUrl
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $shortUrl = $request->user()->shortUrls()->where('id', $id)->first();

        if (!$shortUrl) {
            return response()->json(['message' => 'URL not found'], 404);
        }

        $shortUrl->delete();

        return response()->json(['message' => 'URL deleted successfully']);
    }
    public function show(Request $request, $id)
    {
        $shortUrl = $request->user()->shortUrls()->where('id', $id)->first();

        if (!$shortUrl) {
            return response()->json(['message' => 'URL not found or access denied.'], 404);
        }

        return response()->json([
            'data' => $shortUrl
        ]);
    }

    function redirect($short_code)
    {
        $shortUrl = ShortUrl::where('short_code', $short_code)->firstOrFail();

        if ($shortUrl->expires_at && $shortUrl->expires_at->isPast()) {
            abort(404);
        }

        $shortUrl->increment('clicks');

        return redirect()->away($shortUrl->long_url);
    }

    function storePublic(Request $request)
    {
        $validated = $request->validate([
            "long_url" => "required|url"
        ]);
        $shortCode = Str::random(6);
        $shortUrl = ShortUrl::create([
            'long_url' => $validated['long_url'],
            'short_code' => $shortCode,
            'expires_at' => now()->addHours(24),
        ]);

        return response()->json([
            'message' => 'URL shortened successfully',
            'data'    => $shortUrl
        ], 201);
    }
}
