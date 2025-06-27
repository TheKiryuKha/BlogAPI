<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
{
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

        $this->configureGates();
    }

    private function configureGates(): void
    {
        Gate::define('is-admin', fn (User $user) => $user->tokenCan('admin'));

        Gate::define('is-admin-or-author', function (User $user): bool {
            if ($user->tokenCan('author')) {
                return true;
            }

            return $user->tokenCan('admin');
        });

        Gate::define('update-post', function (User $user, Post $post): bool {
            if ($user->id === $post->user_id && $user->tokenCan('author')) {
                return true;
            }

            return $user->tokenCan('admin');
        });

        Gate::define('update-user', fn (User $user, User $target_user): bool => $user->id === $target_user->id);

        Gate::define('delete-user', fn (User $user, User $target_user): bool => $user->id === $target_user->id
        || $user->tokenCan('admin'));
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
