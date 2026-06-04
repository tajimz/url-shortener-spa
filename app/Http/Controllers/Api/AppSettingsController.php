<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => AppSetting::find(1),
        ]);
    }
}
