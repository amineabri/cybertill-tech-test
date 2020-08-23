<?php

namespace Tests\DummyClasses;

use Domain\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Dummy class required to test the BaseRepository class (which is abstract).
 */
class DummyRepository extends BaseRepository {

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function create(array $data): DummyModel
    {
        // No need to implement
    }

    public function update(Model $model, array $data): DummyModel
    {
        // No need to implement
    }
}
