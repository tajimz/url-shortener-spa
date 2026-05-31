<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Route;

class NotARoute implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Get all routes registered in the application
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            // Get the URI (e.g., "dashboard", "settings/security")
            $uri = $route->uri();

            // Extract the first part of the URL (e.g., "dashboard", "settings")
            $basePath = explode('/', $uri)[0];

            // If the user's alias matches a top-level route, reject it
            if ($value === $basePath) {
                $fail("The alias '{$value}' is reserved for a system page.");
            }
        }
    }
}
