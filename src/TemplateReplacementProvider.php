<?php

namespace Iqbalatma\TemplateReplacement;

use Classid\TemplateReplacement\Console\Commands\GenerateInformationData;
use Illuminate\Support\ServiceProvider;

class TemplateReplacementProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/template_replacement.php', 'template_replacement');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateInformationData::class,
            ]);
        }
        $this->publishes([
            __DIR__.'/Config/template_replacement.php' => config_path('template_replacement.php'),
        ]);
    }
}
