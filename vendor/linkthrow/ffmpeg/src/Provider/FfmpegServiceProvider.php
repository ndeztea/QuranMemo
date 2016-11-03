<?php namespace LinkThrow\Ffmpeg\Provider;

use Linkthrow\Ffmpeg\Classes\FFMPEG;
use Illuminate\Support\ServiceProvider;

class FfmpegServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            realpath(__DIR__.'/../../config/ffmpeg.php') => config_path('ffmpeg.php'),
        ]);

        $config = $this->app['config']['api'];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['ffmpeg'] = $this->app->share(function($app)
        {
            return new FFMPEG;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('ffmpeg');
    }

}
