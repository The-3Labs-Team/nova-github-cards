<?php

namespace The3LabsTeam\NovaGithubCards;

use Illuminate\Support\ServiceProvider;
use Outl1ne\NovaTranslationsLoader\LoadsNovaTranslations;
class NovaGithubCardsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    use LoadsNovaTranslations;
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/nova-github-cards.php' => config_path('nova-github-cards.php'),
        ], 'config');

        $this->loadTranslations(__DIR__ . '/../lang', 'nova-github-cards', true);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
