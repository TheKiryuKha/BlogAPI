<?php

declare(strict_types=1);

namespace App\Providers;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrls();

        Relation::enforceMorphMap([
            'user' => \App\Models\User::class,
        ]);
    }

    public function configureModels(): void
    {
        Model::unguard();
        Model::shouldBeStrict();
    }

    public function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
    }

    public function configureUrls(): void
    {
        URL::forceHttps(app()->isProduction());
    }
}
