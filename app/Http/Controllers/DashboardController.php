<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $urls = $user->shortUrls()->latest()->get();

        return Inertia::render('Dashboard', [
            'total_urls' => $urls->count(),
            'total_clicks' => $urls->sum('clicks'),
            'urls' => $urls,
        ]);
    }
}
