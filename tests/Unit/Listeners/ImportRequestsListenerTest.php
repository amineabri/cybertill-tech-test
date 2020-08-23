<?php

namespace Tests\Unit\Listeners;

use Domain\Models\LogModel;
use Domain\Services\LogService;
use Illuminate\Database\Events\MigrationsEnded;
use Illuminate\Database\Schema\Builder;
use Infrastructure\Exceptions\ModelNotCreatedException;
use Infrastructure\Listeners\ImportRequestsListener;
use Mockery;
use Mockery\Mock;
use Tests\TestCase;

class ImportRequestsListenerTest extends TestCase
{
    /** @var Mock|LogService $mockLogService */
    private $mockLogService;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->mockLogService          = Mockery::mock(LogService::class);
    }

    /**
     * @throws ModelNotCreatedException
     */
    public function test_handle() : void
    {
        // Set APP_ENV to local
        $_ENV['APP_ENV']    = 'local';
        $this->mockLogService
            ->expects()
            ->create()
            ->withAnyArgs()
            ->times(20)
            ->andReturns(Mockery::mock(LogModel::class));
        $event    = new MigrationsEnded();
        $handler  = new ImportRequestsListener($this->mockLogService);
        $handler->handle($event);
        $_ENV['APP_ENV']   = 'testing';
    }
}
