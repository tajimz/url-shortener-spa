<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configureMailNotifications();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn() => Password::min(8));
    }

    /**
     * Customize auth notification emails to match site branding.
     */
    protected function configureMailNotifications(): void
    {
        $appName = config('app.name');

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) use ($appName) {
            return (new MailMessage)
                ->subject(__('Verify your :app email address', ['app' => $appName]))
                ->greeting(__('Hello :name!', ['name' => $notifiable->name ?? __('there')]))
                ->line(__('Thanks for signing up for :app. Please confirm your email address so you can create and manage short links.', ['app' => $appName]))
                ->action(__('Verify Email Address'), $url)
                ->line(__('This verification link will expire in :count minutes.', ['count' => config('auth.verification.expire', 60)]))
                ->line(__('If you did not create an account, you can safely ignore this email.'));
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $url) use ($appName) {
            return (new MailMessage)
                ->subject(__('Reset your :app password', ['app' => $appName]))
                ->greeting(__('Hello :name!', ['name' => $notifiable->name ?? __('there')]))
                ->line(__('We received a request to reset the password for your :app account.', ['app' => $appName]))
                ->action(__('Reset Password'), $url)
                ->line(__('This password reset link will expire in :count minutes.', [
                    'count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
                ]))
                ->line(__('If you did not request a password reset, no further action is required — your password will stay the same.'));
        });
    }
}
