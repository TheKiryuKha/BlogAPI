<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use App\Queries\Contracts\FetchRelationsContract;
use App\Queries\Contracts\PostQueryContract;
use App\Queries\Contracts\UserQueryContract;
use App\Queries\FetchRelations;
use App\Queries\PostQuery;
use App\Queries\UserQuery;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(FetchRelationsContract::class, FetchRelations::class);
        $this->app->bind(PostQueryContract::class, PostQuery::class);
        $this->app->bind(UserQueryContract::class, UserQuery::class);
    }

    public function boot(): void
    {
        $this->configureCommands();
        $this->configureModels();
        $this->configureUrls();
        $this->configureDates();

        Relation::enforceMorphMap([
            'user' => User::class,
            'post' => Post::class,
        ]);
    }

    private function configureDates(): void
    {
        Date::use(CarbonImmutable::class);
    }

    private function configureModels(): void
    {
        Model::shouldBeStrict(! app()->isProduction());
        Model::unguard();
    }

    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
    }

    private function configureUrls(): void
    {
        URL::forceHttps(app()->isProduction());
    }
}
