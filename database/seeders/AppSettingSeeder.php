<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppSetting::firstOrCreate(
            ['id' => 1],
            [
                'android_latest_version' => '1.0.0',
                'android_minimum_version' => '1.0.0',
                'website_version' => '1.0.0',
                'maintenance_web' => false,
                'maintenance_app' => false,
                'maintenance_message' => null,
                'announcement_title' => null,
                'announcement_body' => null,
                'android_app_url' => null,
            ]
        );
    }
}
