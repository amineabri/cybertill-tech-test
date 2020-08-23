<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\LogController;
use App\Http\Resources\LogResource;
use App\Http\Resources\LogWithPaginationResource;
use Domain\Models\LogModel;
use Domain\Services\LogService;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Lumen\Http\Request;
use Mockery;
use Mockery\Mock;
use Tests\TestCase;

class LogControllerTest extends TestCase
{
    /**
     * @var Mock|LogService
     */
    protected $mockLogService;

    /**
     * @var Mock|Request
     */
    protected $mockRequest;

    public function setUp(): void
    {
        parent::setUp();

        $this->mockLogService = Mockery::mock(LogService::class);
        $this->mockRequest = Mockery::mock(Request::class);
    }

    /**
     * Get logs without php pagination
     *
     * @test
     */
    public function withoutPagination(): void
    {
        /** @var Mock|LogModel $mockLog */
        $mockLog = Mockery::mock(Collection::class);
        $mockLog
            ->expects()
            ->toBase()
            ->andReturns($mockLog);
        $mockLog
            ->expects()
            ->content()
            ->andReturns('some-real-json');
        $mockLog
            ->expects()
            ->getStatusCode()
            ->andReturns(200);
        $mockLog
            ->expects()
            ->isNotEmpty()
            ->andReturns(true);

        $mockLog
            ->expects()
            ->count()
            ->andReturns(200);
        $this->mockLogService
            ->expects()
            ->findAll([])
            ->andReturns($mockLog);

        $this->mockLogService
            ->expects()
            ->getFinalData($mockLog)
            ->andReturns($mockLog);

        $controller = new LogController($this->mockLogService);
        $response = $controller->withoutPagination($this->mockRequest);

        $this->assertInstanceOf(LogResource::class, $response);
        $this->assertEquals('some-real-json', $response->content());
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Get logs with php pagination
     *
     * @test
     */
    public function withPagination(): void
    {
        /** @var Mock|LogModel $mockLog */
        $mockLog = Mockery::mock(Collection::class);
        $mockLog
            ->expects()
            ->count()
            ->twice()
            ->andReturns(100);
        $mockLog
            ->expects('slice->all')
            ->andReturns(Mockery::self());
        $mockLog
            ->expects()
            ->isNotEmpty()
            ->andReturns(true);
        $this->mockLogService
            ->expects()
            ->getFinalData($mockLog)
            ->andReturns($mockLog);

        $this->mockLogService
            ->expects()
            ->findAll([])
            ->andReturns($mockLog);
        $this->mockRequest
            ->expects()
            ->has('perPage')
            ->andReturns(false);

        $this->mockRequest
            ->expects()
            ->url()
            ->andReturns('http://localhost');

        $this->mockRequest
            ->expects()
            ->all()
            ->andReturns([]);

        $controller = new LogController($this->mockLogService);
        $response = $controller->withPagination($this->mockRequest);

        $this->assertInstanceOf(LogWithPaginationResource::class, $response);
    }
}
