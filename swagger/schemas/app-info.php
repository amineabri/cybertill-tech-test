<?php

/**
 * @OA\Schema(
 *    schema="app-info",
 *    @OA\Property(
 *      property="application",
 *      type="string",
 *      description="The name of the application."
 *    ),
 *    @OA\Property(
 *      property="version",
 *      type="string",
 *      description="The version of the application."
 *    ),
 *    @OA\Property(
 *      property="time",
 *      type="integer",
 *      description="The current time."
 *    ),
 *    @OA\Property(
 *      property="documentation",
 *      type="integer",
 *      description="The link to the documenttation page."
 *    ),
 *    example={
 *       "application": "Cybertill Developer Test API",
 *       "version": "0.0.1",
 *       "time": 1563375945,
 *       "documentation": "https://localhost/api/v1/documentation"
 *    }
 * )
 */
