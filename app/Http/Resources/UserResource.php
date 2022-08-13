<?php

namespace App\Http\Resources;

use App\Http\Traits\ResourceTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    use ResourceTrait;
    public static $wrap = null;
    public $type = "user";

    public function format($request)
    {
        if (isset($this->diseases->id)) {
            $diseases = DiseaseResorce::make($this->diseases)->format($request);
        } else {
            $diseases = [];
        }

        return [
            'type' => $this->type,
            'id' => $this->id,
            'attributes' => [
                'email' => $this->email,
                'firstName' => $this->first_name,
                'lastName' => $this->last_name,
                'cardId' => $this->card_id,
                'isUnderage' => $this->is_underage,
                'phone' => $this->phone,
                'cellPhone' => $this->cell_phone,
                'address' => $this->address,
                'municipality' => $this->municipality->name,
                'diseases' => $diseases,
            ]
        ];
    }
}
