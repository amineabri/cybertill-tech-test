<?php

namespace Domain\Services;

use Domain\Contracts\LogRepositoryContract;
use Domain\Models\LogModel;
use Illuminate\Database\Eloquent\Collection;
use Infrastructure\Exceptions\ModelNotCreatedException;
use Ramsey\Uuid\Uuid;

/**
 * Class LogService
 * @package Services
 */
class LogService
{
    /**
     * @var LogRepositoryContract
     */
    protected $logRepository;

    /**
     * LogService constructor.
     * @param LogRepositoryContract $logRepository
     */
    public function __construct(LogRepositoryContract $logRepository)
    {
        $this->logRepository         = $logRepository;
    }

    /**
     * Find all records by provided conditions.
     *
     * @param   array $conditions
     *
     * @return  Collection
     */
    public function findAll(array $conditions = []): Collection
    {
        return $this->logRepository->findAll($conditions);
    }

    /**
     * Create a new record
     *
     * @param array $logData
     * @return LogModel
     *
     * @throws ModelNotCreatedException
     */
    public function create(array $logData): LogModel
    {
        /** @var LogModel $logData */
        return $this->logRepository->create($logData);
    }

    /**
     * @param Collection $logs
     * @return mixed
     */
    public function getFinalData(Collection $logs)
    {
        return $logs->groupBy('countryOfOrigin')
                    ->mapToGroups(static function ($log, $name) use ($logs) {
                        $percentage           = $log->sum('responseTime') / ($logs->sum('responseTime') / 100);
                        return [
                        'data'   => [
                        'ref'               => Uuid::uuid4()->toString(),
                        'countryOfOrigin'   => $name,
                        'responseTime'      => round($percentage, 2),
                        'children'          => $log
                        ]
                        ];
                    })
                    ->first();
    }
}
