<?php

namespace App\Http\Controllers;

use App\Http\Resources\DiseaseResorce;
use App\Models\Disease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $diseases = Disease::all();

            if ($diseases->isEmpty())
                return json_success(['data' => []]);

            return json_success(DiseaseResorce::collection($diseases), 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return json_errors(['error' => $e->getMessage()], 500);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'diseaseType' => 'required|string|max:255',
                'attendedInHospital' => 'required|boolean',
                'symptoms' => 'required|string|max:255',
                'fever' => 'required|boolean',
                'skinRashes' => 'required|boolean',
                'cough' => 'required|boolean',
                'muscleAche' => 'required|boolean',
                'headache' => 'required|boolean',
                'vomiting' => 'required|boolean',
            ]);

            if ($validator->fails())
                return json_errors($validator->errors()->getMessages(), 400);

            $user = auth()->user();


            if (!collect(Disease::getTypes())->contains($request->diseaseType))
                return json_errors(['message' => 'Virus desconocido'], 400);

            $diseases = $user->diseases()->create([
                'disease_type' => $request->diseaseType,
                'attended_in_hospital' => $request->attendedInHospital,
                'additional_symptoms' => $request->symptoms,
                'fever' => $request->fever,
                'skin_rashes' => $request->skinRashes,
                'cough' => $request->cough,
                'muscle_ache' => $request->muscleAche,
                'headache' => $request->headache,
                'vomiting' => $request->vomiting,
            ]);

            if ($diseases->id)
                return json_success(DiseaseResorce::make($diseases), 201);
            else
                return json_errors(['message' => 'Error Guardando'], 500);
        } catch (\Throwable $th) {
            Log::error($th);
            return json_errors(['message' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getTypes()
    {
        try {
            return json_success([
                'data' => [
                    'types' => Disease::getTypes()
                ]
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return json_errors(['message' => $th->getMessage()], 500);
        }
    }

    // countDieases
    public function countDieases()
    {
        try {
            $types = Disease::getTypes();

            $data = collect($types)->map(function ($type) {
                $count = Disease::where('disease_type', $type)->count();
                return [
                    'type' => $type,
                    'count' => $count
                ];
            });

            return json_success(['data' => $data]);
        } catch (\Throwable $th) {
            Log::error($th);
            return json_errors(['message' => $th->getMessage()], 500);
        }
    }

    public function stats()
    {
        try {
            $dataByType = [];

            $types = Disease::getTypes();

            collect($types)->each(function ($type) use (&$dataByType) {
                $disease = Disease::where('disease_type', $type)->get();

                $dataByType[$type]['fever'] = 0;
                $dataByType[$type]['skin_rashes'] = 0;
                $dataByType[$type]['cough'] = 0;
                $dataByType[$type]['muscle_ache'] = 0;
                $dataByType[$type]['headache'] = 0;
                $dataByType[$type]['vomiting'] = 0;

                $disease->map(function ($item) use (&$dataByType, $type) {
                    $dataByType[$type]['fever'] += $item->fever ? 1 : 0;
                    $dataByType[$type]['skin_rashes'] += $item->skin_rashes ? 1 : 0;
                    $dataByType[$type]['cough'] += $item->cough ? 1 : 0;
                    $dataByType[$type]['muscle_ache'] += $item->muscle_ache ? 1 : 0;
                    $dataByType[$type]['headache'] += $item->headache ? 1 : 0;
                    $dataByType[$type]['vomiting'] += $item->vomiting ? 1 : 0;
                });
            });

            return json_success(['data' => $dataByType]);
        } catch (\Throwable $th) {
            Log::error($th);
            return json_errors(['message' => $th->getMessage()], 500);
        }
    }
}
