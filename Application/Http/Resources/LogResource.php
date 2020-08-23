<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LogResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toResponse($request): array
    {
        return [
            'data'      =>  $this->collection,
            'settings'  =>  $this->additional
        ];
    }
}
