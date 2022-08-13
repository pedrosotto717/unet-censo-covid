<?php

namespace App\Http\Resources;

use App\Http\traits\ResourceTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalityResource extends JsonResource
{
    use ResourceTrait;
    public static $wrap = null;
    public $type = "municipality";

    public function format($request)
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name
            ]
        ];
    }
}
