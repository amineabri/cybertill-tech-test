<?php

namespace Domain\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Exceptions\ModelNotCreatedException;

interface RepositoryContract
{
    /**
     * Find all records by provided conditions.
     *
     * @param array $conditions
     *
     * @return Collection
     */
    public function findAll(array $conditions = []): Collection;

    /**
     * Create a new record.
     *
     * @param array $data
     *
     * @return Model
     *
     * @throws ModelNotCreatedException
     */
    public function create(array $data): Model;
}
