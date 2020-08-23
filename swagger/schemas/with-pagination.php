<?php
/**
 * @OA\Schema(
 *    schema="with-pagination",
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
 *      property="links",
 *      description="The pagination links.",
 *      type="object",
 *      @OA\Items(
 *          type="object",
 *          @OA\Property(property="first", type="string", description="The first page"),
 *          @OA\Property(property="last", type="string", description="The last page"),
 *          @OA\Property(property="prev", type="string", description="The previous page"),
 *          @OA\Property(property="next", type="string", description="The next page")
 *      )
 *    ),
 *    @OA\Property(
 *      property="meta",
 *      description="The meta data",
 *      type="object",
 *      @OA\Items(
 *          type="object",
 *          @OA\Property(property="current_page", type="string", description="The current page number"),
 *          @OA\Property(property="from", type="integer", description="The first page number"),
 *          @OA\Property(property="last_page", type="integer", description="The last page number"),
 *          @OA\Property(property="path", type="string", description="The path"),
 *          @OA\Property(property="per_page", type="string", description="The number of items per page"),
 *          @OA\Property(property="to", type="integer", description="The distination page"),
 *          @OA\Property(property="total", type="integer", description="The total of recors"),
 *      )
 *    ),
 *    @OA\Property(
 *      property="totalOfRequestRecorded",
 *      description="The meta data",
 *      type="string",
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
 *       "meta": {
 *          "current_page": 1,
 *          "from": 1,
 *          "last_page": 1,
 *          "path": "http://localhost",
 *          "per_page": "10",
 *          "to": 8,
 *          "total": 8,
 *       },
 *       "totalOfRequestRecorded": 40,
 *     }
 * )
 */
