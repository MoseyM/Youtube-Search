<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleAPIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Google_Service_YouTube::class, function($app) {
            $client = new \Google_Client();
            $client->setApplicationName(env('APP_NAME'));
            $client->setDeveloperKey(env('YOUTUBE_API_KEY'));
            return new \Google_Service_YouTube($client);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
