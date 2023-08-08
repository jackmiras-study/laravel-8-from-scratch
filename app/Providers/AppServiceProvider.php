<?php

namespace App\Providers;

use App\Services\ConvertKitNewsletter;
use App\Services\Newsletter;
use MailchimpMarketing\ApiClient;
use App\Services\MailchimpNewsletter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Newsletter::class, function () {
            $client = (new ApiClient)->setConfig([
                "apiKey" => config("services.mailchimp.key"),
                "server" => "us21",
            ]);

            if (env("NEWSLETTER_MAILER") === "convertkit") {
                return new ConvertKitNewsletter();
            }

            return new MailchimpNewsletter($client);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
