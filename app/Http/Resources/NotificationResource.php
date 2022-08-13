<?php

namespace App\Http\Resources;

use App\Http\Traits\ResourceTrait;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    use ResourceTrait;
    public static $wrap = null;
    public $type = "notification";

    public function format($request)
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            ]
        ];
    }
}
