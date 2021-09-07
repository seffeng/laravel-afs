<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2021 seffeng
 */
namespace Seffeng\LaravelAfs;

use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Seffeng\Afs\Exceptions\AfsException;

class AfsServiceProvider extends BaseServiceProvider
{
    /**
     *
     * {@inheritDoc}
     * @see \Illuminate\Support\ServiceProvider::register()
     */
    public function register()
    {
        $this->registerAliases();
        $this->mergeConfigFrom($this->configPath(), 'afs');

        $this->app->singleton('seffeng.laravel.afs', function ($app) {
            $config = $app['config']->get('afs');

            if ($config && is_array($config)) {
                return new Afs($config);
            } else {
                throw new AfsException('Please execute the command `php artisan vendor:publish --tag="afs"` first to generate afs configuration file.');
            }
        });
    }

    /**
     *
     * @author zxf
     * @date    2021年7月30日
     */
    public function boot()
    {
        if ($this->app->runningInConsole() && $this->app instanceof LaravelApplication) {
            $this->publishes([$this->configPath() => config_path('afs.php')], 'afs');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('afs');
        }
    }

    /**
     *
     * @author zxf
     * @date    2021年7月30日
     */
    protected function registerAliases()
    {
        $this->app->alias('seffeng.laravel.afs', Afs::class);
    }

    /**
     *
     * @author zxf
     * @date    2021年7月30日
     * @return string
     */
    protected function configPath()
    {
        return dirname(__DIR__) . '/config/afs.php';
    }
}
