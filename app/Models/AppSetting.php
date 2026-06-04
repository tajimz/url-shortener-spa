<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppSetting extends Model
{
    protected $fillable = [
        'android_latest_version',
        'android_minimum_version',
        'website_version',

        'maintenance_web',
        'maintenance_app',
        'maintenance_message',

        'announcement_title',
        'announcement_body',

        'android_app_url',
    ];


}
