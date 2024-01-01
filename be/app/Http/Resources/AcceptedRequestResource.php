<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AcceptedRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public $status;
  
    public function __construct($status,$message,$resource){
        parent::__construct($resource);
        $this->status = $status;
    }

    public function toArray(Request $request): array
    {
        return [
            'ok' => $this->status,
            'data' => $this->resource
        ];
    }
}
