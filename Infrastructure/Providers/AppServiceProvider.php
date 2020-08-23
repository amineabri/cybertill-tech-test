<?php

namespace Infrastructure\Providers;

use Domain\Contracts\LogRepositoryContract;
use Domain\Models\LogModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Domain\Repositories\EloquentLogRepository;
use Ramsey\Uuid\Uuid;

/**
 * Class AppServiceProvider
 * @package Infrastructure\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(Model::class, LogModel::class);
        $this->app->bind(LogRepositoryContract::class, EloquentLogRepository::class);
    }

    public function boot(): void
    {
        // This injects automatically an uuid when a new oauth2 client is created.
        LogModel::creating(static function (LogModel $log) {
            $log->uuid = Uuid::uuid4()->toString();
        });
    }
}
