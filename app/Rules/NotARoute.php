<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Route;

class NotARoute implements ValidationRule
{
    private array $blocked = [
        'admin',
        'cpanel',
        'dashboard',
        'api',
        'auth',
        'login',
        'logout',
        'register',
        'signup',
        'signin',
        'verify',
        'verification',
        'password',
        'reset',
        'forgot-password',

        'user',
        'users',
        'profile',
        'account',
        'accounts',
        'settings',
        'preferences',

        'system',
        'root',
        'superuser',
        'staff',
        'support',
        'help',
        'helpdesk',

        'home',
        'app',
        'portal',
        'console',
        'panel',
        'backend',
        'frontend',

        'v1',
        'v2',
        'webhook',
        'hooks',
        'graphql',

        'about',
        'contact',
        'privacy',
        'terms',
        'legal',
        'policy',

        'www',
        'mail',
        'ftp',
        'localhost',
        'static',
        'assets',
        'storage',
        'uploads',

        'go',
        'r',
        'redirect',
        's',
        'short',
        'shorten',
        'link',
        'links',
        'stats',
        'analytics',
        'click',
        'track',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $uri = $route->uri();
            $basePath = explode('/', $uri)[0];

            if (
                $value === $basePath ||
                in_array($value, $this->blocked, true)
            ) {
                $fail("The alias '{$value}' is reserved for a system page.");
                return;
            }
        }
    }
}
