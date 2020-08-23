<?php

namespace Tests\Unit\Services;

use Domain\Contracts\LogRepositoryContract;
use Domain\Models\LogModel;
use Illuminate\Database\Eloquent\Collection;
use Domain\Services\LogService;
use Infrastructure\Exceptions\ModelNotCreatedException;
use Mockery;
use Mockery\Mock;
use Tests\TestCase;

/**
 * Class LogServiceTest
 * @package Tests\Unit\Services
 */
class LogServiceTest extends TestCase
{
    /** @var Mock|LogRepositoryContract $mockLogRepositoryContract */
    private $mockLogRepositoryContract;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->mockLogRepositoryContract          = Mockery::mock(LogRepositoryContract::class);
    }

    /**
     * Find all records
     * @test
     * @return void
     */
    public function find_all(): void
    {
        $logs = Mockery::mock(Collection::class);

        $this->mockLogRepositoryContract
            ->expects()
            ->findAll([])
            ->andReturns($logs);

        $service = new LogService($this->mockLogRepositoryContract);
        $result  = $service->findAll([]);

        // the result should be whatever the repo returned
        $this->assertEquals($logs, $result);
    }

    /**
     *  Create new resource
     * @test
     * @return void
     * @throws ModelNotCreatedException
     */
    public function create(): void
    {
        // make up some data
        $dummyData = [
            'ipAddress'         => '127.0.0.1',
            'responseType'      => 200,
            'responseTime'      => 123,
            'countryOfOrigin'   => 'United Kingdom',
            'path'              => '/home/www'
        ];

        $log = Mockery::mock(LogModel::class);

        $this->mockLogRepositoryContract
            ->expects()
            ->create($dummyData)
            ->andReturns($log);

        $service = new LogService($this->mockLogRepositoryContract);
        $result = $service->create($dummyData);

        // the service should return whatever the repo returned
        $this->assertEquals($log, $result);
    }

    /**
     *  Build the final log array
     * @test
     * @return void
     */
    public function get_final_data(): void
    {
        $logs = Mockery::mock(Collection::class);
        $logs
            ->expects()
            ->groupBy('countryOfOrigin')
            ->andReturns(Mockery::self());
        $logs
            ->expects()
            ->mapToGroups()
            ->withAnyArgs()
            ->andReturns(Mockery::self());
        $logs
            ->expects()
            ->first()
            ->andReturns($logs);
        $service = new LogService($this->mockLogRepositoryContract);
        $result  = $service->getFinalData($logs);

        $this->assertEquals($logs, $result);
    }
}
