<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommonErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public $status;
    public $error;
    public $msg;

    public function __construct($status,$error,$msg){
        // parent::__construct($resource);
        $this->status = $status;
        $this->error = $error;
        $this->msg = $msg;
    }

    public function toArray(Request $request): array
    {
        return [
            'ok' => $this->status,
            'error' => $this->error,
            'msg' => $this->msg
        ];
    }
}
