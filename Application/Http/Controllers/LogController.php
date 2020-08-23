<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogResource;
use App\Http\Resources\LogWithPaginationResource;
use Domain\Services\LogService;
use Domain\Traits\PaginationTrait;
use Laravel\Lumen\Http\Request;

/**
 * Class LogController
 * @package App\Http\Controllers
 */
class LogController extends Controller
{
    use PaginationTrait;

    /**
     * @var LogService
     */
    protected $logService;

    /**
     * @var array $filters
     */
    private $filters = [];

    /**
     * TechTestController constructor.
     * @param LogService $logService
     */
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }

    /**
     * Get logs without pagination
     *
     * @param Request $request
     * @return LogResource
     */
    public function withoutPagination(Request $request):LogResource
    {
        $logs               = $this->logService->findAll($this->filters);
        if ($logs->isNotEmpty()) {
            $newLogsData = $this->logService->getFinalData($logs);
            return (new LogResource($newLogsData))->additional(['totalOfRequestRecorded' => $logs->count()]);
        }
        return (new LogResource(collect()))->additional(['totalOfRequestRecorded' => 0]);
    }

    /**
     * Get Logs with php pagination
     *
     * @param Request $request
     * @return LogWithPaginationResource
     */
    public function withPagination(Request $request): LogWithPaginationResource
    {
        $logs                     = $this->logService->findAll($this->filters);
        if ($logs->isNotEmpty()) {
            $newLogsData = $this->logService->getFinalData($logs);
            $paginatedItems           = $this->getItems($newLogsData, $request);
            return (new LogWithPaginationResource($paginatedItems))->additional([
                'totalOfRequestRecorded' => $logs->count()
            ]);
        }
        return (new LogWithPaginationResource(collect()))->additional(['totalOfRequestRecorded' => 0]);
    }
}
