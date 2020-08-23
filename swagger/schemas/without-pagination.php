<?php
/**
 * @OA\Schema(
 *    schema="without-pagination",
 *    @OA\Property(
 *        property="data",
 *        description="List of logs",
 *        type="array",
 *        @OA\Items(
 *            type="object",
 *            @OA\Property(property="ref", type="string", description="The log's UUID"),
 *            @OA\Property(property="countryOfOrigin", type="string", description="The country of origin"),
 *            @OA\Property(property="responseTime", type="integer", description="The proportions of requests from each Country."),
 *            @OA\Property(
 *              property="children",
 *              type="array",
 *              description="List of logs assigned to this country",
 *              @OA\Items(
 *                @OA\Property(property="uuid", type="string", description="The log's UUID"),
 *                @OA\Property(property="ipAddress", type="string", description="The ip address"),
 *                @OA\Property(property="responseType", type="integer", description="The response type."),
 *                @OA\Property(property="responseTime", type="integer", description="The response time."),
 *                @OA\Property(property="countryOfOrigin", type="string", description="The country of origin."),
 *                @OA\Property(property="path", type="string", description="The path."),
 *                @OA\Property(property="createdAt", type="string", description="The creation date."),
 *                @OA\Property(property="updatedAt", type="string", description="The updating date."),
 *              )
 *            )
 *        )
 *    ),
 *    @OA\Property(
 *      property="settings",
 *      description="The settings.",
 *      type="object",
 *      @OA\Items(
 *          type="object",
 *          @OA\Property(property="totalOfRequestRecorded", type="integer", description="The total of request recorded"),
 *      )
 *    ),
 *    example={
 *       "data": {
 *           "ref": "5a156447-2127-4c6b-a25c-03355233d13b",
 *           "countryOfOrigin": "Ukraine",
 *           "responseTime": 7.02,
 *           "children": {
 *              {
 *                  "uuid": "4137e2b8-daed-447f-85c9-21a5b06d3146",
 *                  "ipAddress": "192.168.0.6",
 *                  "responseType": 200,
 *                  "responseTime": 164,
 *                  "countryOfOrigin": "Ukraine",
 *                  "path": "/home",
 *                  "createdAt": "2020-08-23T13:19:32.000000Z",
 *                  "updatedAt": "2020-08-23T13:19:32.000000Z"
 *              }
 *           }
 *       },
 *       "settings": {"totalOfRequestRecorded": 40}
 *     }
 * )
 */
