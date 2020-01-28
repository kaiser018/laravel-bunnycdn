<?php
    /**

namespace App\Providers;


class BunnycdnServiceProvider extends Ftp
{
    public function __construct($config)
    {
        dd($config);
        $this->safeStorage = new SafeStorage();
        $this->setConfig($config);
    }
}
*/

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use App\Adapters\Bunnycdn;
use Storage;

class BunnycdnServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('bunnycdn', function ($app, $config) {
            return new Filesystem(new Bunnycdn($config));
        });
    }
}