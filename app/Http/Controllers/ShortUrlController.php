<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Rules\NotARoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = auth('sanctum')->user() ?? Auth::user();
        if (!$user) {
            $request->request->remove('short_code');
        }

        $validated = $request->validate([
            'long_url' => 'required|url',
            'short_code' => ['nullable', 'min:3', 'max:10', 'unique:short_urls,short_code', new NotARoute(),],
        ]);

        $shortCode = $validated['short_code'] ?? Str::random(6);


        if ($user) {
            $shortUrl = $user->shortUrls()->create([
                'long_url' => $validated['long_url'],
                'short_code' => $shortCode,
            ]);
        } else {
            $shortUrl = ShortUrl::create([
                'long_url' => $validated['long_url'],
                'short_code' => $shortCode,
                'expires_at' => now()->addHours(24)
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'URL shortened successfully',
                'data' => $shortUrl
            ], 201);
        }

        return back()->with('success', 'URL shortened successfully!')
            ->with('short_url', $shortUrl);
    }

    public function destroy(Request $request, $id)
    {
        $shortUrl = $request->user()->shortUrls()->where('id', $id)->first();

        if (!$shortUrl) {
            return response()->json(['message' => 'URL not found'], 404);
        }

        $shortUrl->delete();

        if ($request->expectsJson) return response()->json(['message' => 'URL deleted successfully']);
        return back()->with('success', 'URL Deleted successfully!');
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
}
