<?php namespace BeGooD33\Docusign;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class DocusignServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('docusign.php'),
        ]);
    }

    public function register()
    {
        $this->app->singleton('docusign', function ()
        {
            return new Docusign(config('docusign'));
        });

        $this->app->booting(function()
        {
            AliasLoader::getInstance()->alias('Docusign', 'BeGooD33\Docusign\Facades\Docusign');
        });
    }

    public function provides()
    {
        return ['docusign'];
    }

}
