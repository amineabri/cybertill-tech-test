<?php
/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->group(['prefix' => 'api'], function ($router) {
    /**
     * @OA\Get(
     *   path="/api",
     *   summary="Display basic app information",
     *   @OA\Response(
     *         response=200,
     *         description="Display basic app information.",
     *         @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/app-info")
     *         )
     *     ),
     * )
     */
    $router->get('/', function() {
        return response()->json([
            'application'   => config('app.name'),
            'version'       => 'V0.0.1',
            'time'          => time(),
            'documentation' => route('api.documentation', [], true),
        ]);
    });

    /**
     * @OA\Get(
     *     path="/api/logs/without-pagination",
     *     summary="Get a list of logs without php pagination.",
     *     description="Get a list of logs.",
     *     operationId="getLogs",
     *     tags={"logs-without-pagination"},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/without-pagination")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/error5xx"),
     *     )
     * )
     */
    $router->get('/logs/without-pagination', [
        'as' => 'api.logs.get.all.without.pagination',
        'uses' => 'LogController@withoutPagination'
    ]);

    /**
     * @OA\Get(
     *     path="/api/logs/with-pagination",
     *     summary="Get a list of logs with php pagination.",
     *     description="Get a list of logs.",
     *     operationId="getLogsWithPagination",
     *     tags={"logs-with-pagination"},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/with-pagination")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/error5xx"),
     *     )
     * )
     */
    $router->get('/logs/with-pagination', [
        'as' => 'api.logs.get.all.with.pagination',
        'uses' => 'LogController@withPagination'
    ]);
});
