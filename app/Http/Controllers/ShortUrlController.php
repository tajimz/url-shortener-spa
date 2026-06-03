<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Rules\NotARoute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ShortUrlController extends Controller
{
    //

    function index(Request $request)
    {
        $user = $request->user();

        $urls = $user->shortUrls()->latest()->get();

        if ($request->expectsJson()){
            return response()->json([
                'data' => $urls,
                'total_urls' => $urls->count(),
                'total_clicks' => $urls->sum('clicks'),
            ]);
        }
        return Inertia::render('Dashboard', [
            'total_urls' => $urls->count(),
            'total_clicks' => $urls->sum('clicks'),
            'urls' => $urls,
        ]);

    }
    function store(Request $request)
    {
        $user = auth('sanctum')->user() ?? Auth::user();
        if (!$user) {
            $request->request->remove('short_code');
            $request->request->remove('password');
        }

        $validated = $request->validate([
            'long_url' => 'required|url',
            'password' => ['nullable', 'string', 'min:4', 'max:50', 'regex:/^[A-Za-z0-9@#$_\-]+$/'],
            'short_code' => ['nullable', 'min:3', 'max:20', 'unique:short_urls,short_code', new NotARoute(),],
        ]);

        $shortCode = $validated['short_code'] ?? Str::random(6);


        if ($user) {
            $shortUrl = $user->shortUrls()->create([
                'long_url' => $validated['long_url'],
                'short_code' => $shortCode,
                'password' => isset($validated['password']) ? Hash::make($validated['password']) : null,
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
        if ($shortUrl->password) {
            return redirect("/{$shortUrl->short_code}/password");
        }

        $shortUrl->increment('clicks');

        return redirect()->away($shortUrl->long_url);
    }

    function showPasswordForm($short_code)
    {
        $shortUrl = $shortUrl = ShortUrl::where('short_code', $short_code)->firstOrFail();
        if (!$shortUrl->password) {

            return $this->redirect($short_code);
        }

        return Inertia::render('shorturls/VerifyPassword', [
            'shortUrl' => $shortUrl
        ]);
    }

    function verifyPassword(Request $request, $short_code)
    {
        $request->validate([
            'password' => 'required|string'
        ]);

        $shortUrl = $shortUrl = ShortUrl::where('short_code', $short_code)->firstOrFail();

        if ($shortUrl->expires_at && $shortUrl->expires_at->isPast()) {
            abort(404);
        }

        if (!Hash::check($request->password, $shortUrl->password)) {
            return back()->withErrors([
                'password' => 'The password is not correct'
            ]);
        }

        $shortUrl->increment('clicks');

        return Inertia::location($shortUrl->long_url);
    }
}
