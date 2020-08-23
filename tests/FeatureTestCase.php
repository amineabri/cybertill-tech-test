<?php

namespace Tests;

use Carbon\Carbon;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

/**
 * Class FeatureTestCase
 * @package Tests
 */

abstract class FeatureTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * The base URL to use while testing the application.
     *
     * @var string $baseUrl
     */
    public $baseUrl = 'http://localhost/api';

    /**
     * Set up
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        config(['app.url' => $this->baseUrl]);
        Carbon::setTestNow(Carbon::now());
    }

    /**
     * Tear down
     *
     * @return void
     */
    public function tearDown(): void
    {
        Carbon::setTestNow();
        parent::tearDown();
    }
}
