<?php

namespace App\Http\Utilities;

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

  public static function collection($collection, $paginate = null)
  {
    $data = $collection->map(function ($item) {
      return removeSlashes(self::make($item)->format(request()));
    });

    if ($paginate)
      return [
        'data' => $data,
        'paginate' => $paginate,
      ];


    return [
      'data' => $data
    ];
  }
}
