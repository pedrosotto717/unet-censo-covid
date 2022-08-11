<?php

namespace App\Http\Controllers;

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
        //
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
                'attendedInHostpital' => 'required|boolean',
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

            $user->diseases()->create([
                'disease_type' => $request->diseaseType,
                'attended_in_hostpital' => $request->attendedInHostpital,
                'symptoms' => $request->symptoms,
                'fever' => $request->fever,
                'skin_rashes' => $request->skinRashes,
                'cough' => $request->cough,
                'muscle_ache' => $request->muscleAche,
                'headache' => $request->headache,
                'vomiting' => $request->vomiting,
            ]);
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
}
