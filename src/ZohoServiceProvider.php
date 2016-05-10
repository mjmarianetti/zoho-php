<?php

namespace Mjmarianetti\Zoho;

use Illuminate\Support\ServiceProvider;

class ZohoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->isLumen()) {
            return;
        }

      // Publish config files
      $this->publishes([
          __DIR__.'/../config/config.php' => config_path('zoho.php'),
      ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerZoho();
    }

    /**
     * Register the application bindings.
     */
    private function registerZoho()
    {
        $this->app->bind('SammyK\LaravelFacebookSdk\LaravelFacebookSdk', function ($app) {
          if ($this->isLumen()) {
              $app->configure('zoho');
          }

          return new  ZohoClient();
      });
    }

    private function isLumen()
    {
        return is_a(\app(), 'Laravel\Lumen\Application');
    }
}
