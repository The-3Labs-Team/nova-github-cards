<?php

namespace The3LabsTeam\NovaGithubCards;

use Illuminate\Support\ServiceProvider;

class NovaGithubCardsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/nova-github-cards.php' => config_path('nova-github-cards.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
