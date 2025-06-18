<?php

declare(strict_types=1);

namespace App\Providers;

use Carbon\CarbonImmutable;
use Date;
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
        $this->configureDates();

        Relation::enforceMorphMap([
            'user' => \App\Models\User::class,
            'post' => \App\Models\Post::class,
        ]);
    }

    public function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
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
