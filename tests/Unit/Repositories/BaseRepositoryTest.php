<?php

namespace Tests\Unit\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Mockery;
use Mockery\Mock;
use Tests\DummyClasses\DummyRepository;
use Tests\TestCase;

class BaseRepositoryTest extends TestCase
{
    /**
     * @var Mock|Model
     */
    private $mockModel;

    /**
     * Set up
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->mockModel = Mockery::mock(Model::class);
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
     * Test finding all available resources - no filters.
     * @test
     * @return void
     */
    public function findAll(): void
    {
        $this->mockModel
            ->shouldReceive('newQuery')->once()->withNoArgs()->andReturnSelf()
            ->shouldReceive('orderBy')->once()->with('id', 'asc')->andReturnSelf()
            ->shouldReceive('take')->once()->with(50)->andReturnSelf()
            ->shouldReceive('offset')->once()->with(0)->andReturnSelf()
            ->shouldReceive('get')->once()->andReturn(new Collection([1, 2, 3]));

        $this->mockModel->shouldReceive('count')->andReturn(3);

        $baseRepository = new DummyRepository($this->mockModel);

        $result = $baseRepository->findAll();

        $this->assertEquals('Illuminate\Database\Eloquent\Collection', get_class($result));
        $this->assertEquals(3, count($result));
    }

    /**
     * Test finding all available resources - with where conditions.
     * @test
     * @return void
     */
    public function findAllWithConditions(): void
    {
        $conditions = [
            'where' => [
                ['uuid', '=', 'uuid'],
                ['id', 'LIKE', 'id']
            ],
            'sortBy' => 'uuid',
            'orderBy' => 'desc'
        ];

        $this->mockModel
            ->shouldReceive('newQuery')->once()->withNoArgs()->andReturnSelf()
            ->shouldReceive('where')->once()->with($conditions['where'][0][0], $conditions['where'][0][1], $conditions['where'][0][2])->andReturnSelf()
            ->shouldReceive('where')->once()->with($conditions['where'][1][0], $conditions['where'][1][1], $conditions['where'][1][2])->andReturnSelf()
            ->shouldReceive('orderBy')->once()->with('uuid', 'desc')->andReturnSelf()
            ->shouldReceive('take')->once()->with(50)->andReturnSelf()
            ->shouldReceive('offset')->once()->with(0)->andReturnSelf()
            ->shouldReceive('get')->once()->andReturn(new Collection([1, 2, 3]));

        $this->mockModel->shouldReceive('count')->andReturn(3);

        $baseRepository = new DummyRepository($this->mockModel);

        $result = $baseRepository->findAll($conditions);

        $this->assertEquals(Collection::class, get_class($result));
        $this->assertEquals(3, count($result));
    }

    /**
     * Test finding all available resources - not found.
     * @test
     * @return void
     */
    public function findAllNotFound(): void
    {
        $conditions = [
            'where' => [
                ['uuid', '=', 'uuid'],
                ['id', 'LIKE', 'id']
            ],
        ];

        $this->mockModel
            ->shouldReceive('newQuery')->once()->withNoArgs()->andReturnSelf()
            ->shouldReceive('where')->once()->with($conditions['where'][0][0], $conditions['where'][0][1], $conditions['where'][0][2])->andReturnSelf()
            ->shouldReceive('where')->once()->with($conditions['where'][1][0], $conditions['where'][1][1], $conditions['where'][1][2])->andReturnSelf()
            ->shouldReceive('orderBy')->once()->with('id', 'asc')->andReturnSelf()
            ->shouldReceive('take')->once()->with(50)->andReturnSelf()
            ->shouldReceive('offset')->once()->with(0)->andReturnSelf()
            ->shouldReceive('get')->once()->andReturn(new Collection());

        $this->mockModel->shouldReceive('count')->andReturn(0);

        $baseRepository = new DummyRepository($this->mockModel);

        $result = $baseRepository->findAll($conditions);

        $this->assertEquals(Collection::class, get_class($result));
        $this->assertEquals(0, count($result));
    }
}
