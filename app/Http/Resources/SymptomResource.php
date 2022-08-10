<?php

namespace App\Http\Resources;

use App\Http\Traits\ResourceTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class SymptomResource extends JsonResource
{
    use ResourceTrait;
    public static $wrap = null;
    public $type = "symptom";

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
