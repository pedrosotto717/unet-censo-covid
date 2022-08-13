<?php

namespace App\Http\Controllers;

use App\Http\Resources\MunicipalityResource;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MunicipalityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $municipalities = Municipality::all();

            if ($municipalities->isEmpty())
                return json_success(['data' => []]);

            return json_success(MunicipalityResource::collection($municipalities), 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return json_errors(["message" => $th->getMessage()], 500);
        }
    }
}
