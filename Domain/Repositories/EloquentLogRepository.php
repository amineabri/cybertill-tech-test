<?php

namespace Domain\Repositories;

use Domain\Contracts\LogRepositoryContract;
use Domain\Models\LogModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Infrastructure\Exceptions\ModelNotCreatedException;
use Ramsey\Uuid\Uuid;

/**
 * Class EloquentLogRepository
 * @package Domain\Repositories
 */
class EloquentLogRepository extends BaseRepository implements LogRepositoryContract
{
    /**
     * EloquentLogRepository constructor.
     *
     * @param LogModel $model
     */
    public function __construct(LogModel $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return Model
     * @throws ModelNotCreatedException
     */
    public function create(array $data): Model
    {
        /** @var LogModel $model */
        $model                          = $this->model->newInstance();
        $model->uuid                    = Uuid::uuid5(Uuid::NAMESPACE_DNS, Str::random(64))->toString();
        $model->ipAddress               = $data['ipAddress'];
        $model->responseType            = $data['responseType'];
        $model->responseTime            = $data['responseTime'];
        $model->countryOfOrigin         = $data['countryOfOrigin'];
        $model->path                    = $data['path'];

        if (!$model->save()) {
            throw new ModelNotCreatedException();
        }
        return $model;
    }
}
