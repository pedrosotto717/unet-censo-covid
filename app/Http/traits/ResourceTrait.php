<?php

namespace App\Http\Traits;

trait ResourceTrait
{
    public function toArray($request)
    {
        return [
            $this->type ?? 'data' => removeSlashes($this->format($request)) ?? [],
        ];
    }

    public function format($request)
    {
        return [];
    }

    public static function collection($collection)
    {
        $data = $collection->map(function ($item) {
            return removeSlashes(self::make($item)->format(request()));
        });

        return [
            'data' => $data
        ];
    }
}
