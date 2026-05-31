<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('Welcome', [
            'total_urls'   => ShortUrl::count(),
            'total_clicks' => ShortUrl::sum('clicks'),
            'total_users'  => User::count(),
        ]);
    }
}
