<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class LogWithPaginationResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'data'  =>  $this->collection,
        ];
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param Request $request
     * @param  Response  $response
     * @return void
     */
    public function withResponse($request, $response): void
    {
        $total = json_decode($response->getContent(), true) ?? [];
        $response->header('X-Pagination-Total-Entries', !empty($total['data']) ? $total['meta']['total']:0);
    }
}
