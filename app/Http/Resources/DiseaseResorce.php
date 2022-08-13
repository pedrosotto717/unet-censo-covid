<?php

namespace App\Http\Resources;

use App\Http\traits\ResourceTrait;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DiseaseResorce extends JsonResource
{
    use ResourceTrait;
    public static $wrap = null;
    public $type = "disease";

    public function format($request)
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'attributes' => [
                'diseaseType' => $this->disease_type,
                'attendedInHospital' => $this->attended_in_hospital,
                'symptoms' => $this->additional_symptoms,
                'fever' => $this->fever,
                'skinRashes' => $this->skin_rashes,
                'cough' => $this->cough,
                'muscleAche' => $this->muscle_ache,
                'headache' => $this->headache,
                'vomiting' => $this->vomiting,
                'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            ]
        ];
    }
}
