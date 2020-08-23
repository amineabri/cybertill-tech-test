<?php

namespace Tests\Unit\Repositories;

use Domain\Models\LogModel;
use Domain\Repositories\EloquentLogRepository;
use Infrastructure\Exceptions\ModelNotCreatedException;
use Mockery;
use Mockery\Mock;
use Tests\TestCase;

/**
 * Class EloquentLogRepositoryTest
 * @package Tests\Unit\Repositories
 */
class EloquentLogRepositoryTest extends TestCase
{
    /**
     * @var Mock|LogModel
     */
    private $mockLogModel;

    /**
     * @var array $dummyData
     */
    private $dummyData = [
        'ipAddress'         => '127.0.0.1',
        'responseType'      => 200,
        'responseTime'      => 123,
        'countryOfOrigin'   => 'United Kingdom',
        'path'              => '/home/www'
    ];

    /**
     * Set up
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->mockLogModel = Mockery::mock(LogModel::class);
    }

    /**
     * Tear down
     *
     * @return void
     */
    public function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    /**
     * Test create new resource.
     * @test
     * @return void
     * @throws ModelNotCreatedException
     */
    public function create(): void
    {
        /** @var Mock|LogModel $instance */
        $instance = \Mockery::mock(LogModel::class);
        $this->mockLogModel
            ->expects()
            ->newInstance()
            ->andReturns($instance);

        // the new instance needs to have the valid properties set from the data
        $instance
            ->expects()
            ->setAttribute('uuid', \Mockery::any());

        $instance
            ->expects()
            ->setAttribute('ipAddress', \Mockery::any());
        $instance
            ->expects()
            ->setAttribute('responseType', \Mockery::any());

        $instance
            ->expects()
            ->setAttribute('responseTime', \Mockery::any());

        $instance
            ->expects()
            ->setAttribute('countryOfOrigin', \Mockery::any());

        $instance
            ->expects()
            ->setAttribute('path', \Mockery::any());


        // the new instance needs to be saved.
        $instance
            ->expects()
            ->save()
            ->andReturns(true);

        // create the repo and create a new instance
        $repo = new EloquentLogRepository($this->mockLogModel);
        $result = $repo->create($this->dummyData);

        // the new instance should be returned
        $this->assertEquals($instance, $result);
    }

    /**
     * Create new resource failed.
     * @test
     * @return void
     * @throws ModelNotCreatedException
     */
    public function create_failure(): void
    {


        /** @var Mock|LogModel $instance */
        $instance = \Mockery::mock(LogModel::class);
        $this->mockLogModel
            ->expects()
            ->newInstance()
            ->andReturns($instance);

        // the new instance needs to have the valid properties set from the data
        $instance
            ->expects()
            ->setAttribute('uuid', \Mockery::any());

        $instance
            ->expects()
            ->setAttribute('ipAddress', \Mockery::any());
        $instance
            ->expects()
            ->setAttribute('responseType', \Mockery::any());

        $instance
            ->expects()
            ->setAttribute('responseTime', \Mockery::any());

        $instance
            ->expects()
            ->setAttribute('countryOfOrigin', \Mockery::any());

        $instance
            ->expects()
            ->setAttribute('path', \Mockery::any());

        // the new instance needs to be saved. but this will fail
        $instance
            ->expects()
            ->save()
            ->andReturns(false);

        // create the repo
        $repo = new EloquentLogRepository($this->mockLogModel);

        // create a new instance. since the save fails it should throw an exception
        $this->expectException(ModelNotCreatedException::class);
        $repo->create($this->dummyData);
    }
}
