<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('android_latest_version')->default('1.0.0');
            $table->string('android_minimum_version')->default('1.0.0');

            $table->string('website_version')->default('1.0.0');

            $table->boolean('maintenance_web')->default(false);
            $table->boolean('maintenance_app')->default(false);
            $table->text('maintenance_message')->nullable();

            $table->string('announcement_title')->nullable();
            $table->text('announcement_body')->nullable();

            $table->string('android_app_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
