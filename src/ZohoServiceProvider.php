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
        $this->app->bind('Mjmarianetti\Zoho\ZohoClient', function ($app) {
          if ($this->isLumen()) {
              $app->configure('zoho');
          }

          $config = [];
          $config['authtoken'] = config('zoho.authtoken');
          $config['scope'] = config('zoho.scope');
          $config['format'] = config('zoho.format','json');
          $config['baseurl'] = config('zoho.baseurl','https://crm.zoho.com/crm/private/');
          return new  ZohoClient($config);
      });
    }

    private function isLumen()
    {
        return is_a(\app(), 'Laravel\Lumen\Application');
    }
}
