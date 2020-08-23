<?php

namespace Tests\Feature\Api\Logs;

use Domain\Models\LogModel;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Tests\FeatureTestCase;

class GetLogsTest extends FeatureTestCase
{
    use DatabaseMigrations;

    /**
     * Get all logs without pagination
     *
     * @test
     */
    public function get_logs_without_pagination(): void
    {
        $logs = factory(LogModel::class)->create();

        // try to fetch all logs
        $response = $this->get('/logs/without-pagination', [
            'Accept'       => 'application/json',
            'content_type' => 'application/json'
        ]);

        // confirm the operation worked
        $response->assertResponseOk();
        $response->assertResponseStatus(200);

        $responseData = json_decode($response->response->getContent(), true);
        $responseData = $responseData['data'];

        $this->assertCount($logs->count(), $responseData);

        // make sure each item has the right stuff in it
        foreach($responseData as $value) {
            $this->assertArrayHasKey('countryOfOrigin', $value);
            $this->assertArrayHasKey('responseTime', $value);
            $this->assertIsArray($value['children']);
            $this->assertCount(1, $value['children']);
            $this->assertEquals($logs->uuid, $value['children'][0]['uuid']);
            $this->assertEquals($logs->ipAddress, $value['children'][0]['ipAddress']);
            $this->assertEquals($logs->responseType, $value['children'][0]['responseType']);
            $this->assertEquals($logs->responseTime, $value['children'][0]['responseTime']);
            $this->assertEquals($logs->countryOfOrigin, $value['children'][0]['countryOfOrigin']);
            $this->assertEquals($logs->path, $value['children'][0]['path']);
        }
    }

    /**
     * Get all logs : this shouldn't return data
     *
     * @test
     */
    public function get_logs_without_pagination_without_data(): void
    {
        // try to fetch all logs
        $response = $this->get('/logs/without-pagination', [
            'Accept'       => 'application/json',
            'content_type' => 'application/json'
        ]);

        // confirm the operation worked
        $response->assertResponseOk();
        $response->assertResponseStatus(200);

        $responseData = json_decode($response->response->getContent(), true);
        $responseData = $responseData['data'];

        $this->assertCount(0, $responseData);
    }

    /**
     * Get all logs with pagination
     *
     * @test
     */
    public function get_logs_with_pagination(): void
    {
        $logs = factory(LogModel::class)->create();

        // try to fetch all logs
        $response = $this->get('/logs/with-pagination', [
            'Accept'       => 'application/json',
            'content_type' => 'application/json'
        ]);

        // confirm the operation worked
        $response->assertResponseOk();
        $response->assertResponseStatus(200);

        $responseData = json_decode($response->response->getContent(), true);
        $responseData = $responseData['data'];

        $this->assertCount($logs->count(), $responseData);
        $this->assertEquals($logs->count(), $response->response->headers->get('X-Pagination-Total-Entries'));

        // make sure each item has the right stuff in it
        foreach($responseData as $value) {
            $this->assertArrayHasKey('countryOfOrigin', $value);
            $this->assertArrayHasKey('responseTime', $value);
            $this->assertIsArray($value['children']);
            $this->assertCount(1, $value['children']);
            $this->assertEquals($logs->uuid, $value['children'][0]['uuid']);
            $this->assertEquals($logs->ipAddress, $value['children'][0]['ipAddress']);
            $this->assertEquals($logs->responseType, $value['children'][0]['responseType']);
            $this->assertEquals($logs->responseTime, $value['children'][0]['responseTime']);
            $this->assertEquals($logs->countryOfOrigin, $value['children'][0]['countryOfOrigin']);
            $this->assertEquals($logs->path, $value['children'][0]['path']);
        }
    }

    /**
     * Get all logs : this shouldn't return data
     *
     * @test
     */
    public function get_logs_with_pagination_without_data(): void
    {
        // try to fetch all logs
        $response = $this->get('/logs/with-pagination', [
            'Accept'       => 'application/json',
            'content_type' => 'application/json'
        ]);

        // confirm the operation worked
        $response->assertResponseOk();
        $response->assertResponseStatus(200);

        $responseData = json_decode($response->response->getContent(), true);
        $responseData = $responseData['data'];
        $this->assertCount(0, $responseData);
        $this->assertEquals(0, $response->response->headers->get('X-Pagination-Total-Entries'));
    }
}
