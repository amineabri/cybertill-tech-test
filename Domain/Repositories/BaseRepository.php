<?php

namespace Domain\Repositories;

use Carbon\Carbon;
use Domain\Contracts\RepositoryContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Class BaseRepository
 * @package Domain\Repositories
 */
abstract class BaseRepository implements RepositoryContract
{
    /**
     * @var string $cacheKey
     */
    private $cacheKey;

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model      = $model;
        $this->cacheKey   = strtolower(class_basename($this->model));
    }

    /**
     * @inheritDoc
     */
    public function findAll(array $conditions = []): Collection
    {
        $cacheKey      = $this->getCacheKey();
        $query         = $this->model->newQuery();
        $cacheLifetime = config('logs.cache.lifeTime');
        return Cache::remember(
            $cacheKey,
            Carbon::now()->addMinutes($cacheLifetime),
            static function () use ($query, $conditions) {
                if (isset($conditions['where']) && is_array($conditions['where'])) {
                    foreach ($conditions['where'] as $conditionData) {
                        $query->where($conditionData[0], $conditionData[1], $conditionData[2]);
                    }
                }
                // Apply ordering
                $query->orderBy($conditions['sortBy'] ?? 'id', $conditions['orderBy'] ?? 'asc');
                return $query->take($conditions['limit'] ?? 50)->offset($conditions['offset'] ?? 0)->get();
            }
        );
    }

    /**
     * @inheritDoc
     */
    abstract public function create(array $data): Model;

    /**
     * @return string
     */
    private function getCacheKey(): string
    {
        $cacheLifetime = config('logs.cache.defaultKey');
        return $this->cacheKey ?? $cacheLifetime;
    }
}
