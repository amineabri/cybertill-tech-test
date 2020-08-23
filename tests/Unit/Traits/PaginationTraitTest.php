<?php

namespace Tests\Unit\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravel\Lumen\Http\Request;
use Mockery;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class PaginationTraitTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $mockPaginationTrait;

    /**
     * @var Request
     */
    private $mockRequest;

    /**
     * @var Collection
     */
    private $mockCollection;


    public function setUp(): void
    {
        parent::setUp();
        $this->mockPaginationTrait     = $this->getMockForTrait('\Domain\Traits\PaginationTrait');
        $this->mockRequest              = Mockery::mock(Request::class);
        $this->mockCollection           = Mockery::mock(Collection::class);
    }

    /**
     * Get the paginated items
     *
     * @test
     */
    public function get_items(): void
    {
        $this->mockRequest
            ->expects()
            ->has('perPage')
            ->andReturns(true);
        $this->mockRequest
            ->expects()
            ->get('perPage')
            ->andReturns(25);
        $this->mockRequest
            ->expects()
            ->url();
        $this->mockRequest
            ->expects()
            ->all();
        $this->mockCollection
            ->expects()
            ->all()
            ->andReturns(Mockery::mock(Collection::class));
        $this->mockCollection
            ->expects()
            ->count()
            ->andReturns(50);

        $this->mockCollection
            ->expects()
            ->slice(0, 25)
            ->andReturnSelf();

        $this->assertInstanceOf(LengthAwarePaginator::class, $this->mockPaginationTrait->getItems($this->mockCollection, $this->mockRequest));
    }

    /**
     * Set the number of items per page
     *
     * @test
     */
    public function set_per_page(): void
    {
        $this->mockRequest
            ->expects()
            ->has('perPage')
            ->andReturns(true);
        $this->mockRequest
            ->expects()
            ->get('perPage')
            ->andReturns(25);
        $this->mockPaginationTrait->setPerPage($this->mockRequest);
        $this->assertEquals(25, $this->mockPaginationTrait->getItemPerPage());
    }
}
