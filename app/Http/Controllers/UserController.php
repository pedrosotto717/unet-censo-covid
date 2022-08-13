<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $user = User::all() ?? [];
            if ($user->isEmpty())
                return json_success(['data' => []]);

            return json_success(UserResource::collection($user));
        } catch (\Throwable $th) {
            Log::error($th);
            return json_errors($th->getMessage(), 500);
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'passwordConfirmation' => 'required_with:password|same:password|min:6',
            'cardId' => 'required|string|max:255',
            'isUnderage' => 'required|boolean',
            'phone' => 'required|string|max:255',
            'cellPhone' => 'required|string|max:255',
            'municipalityId' => 'required|integer',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails())
            return json_errors($validator->errors()->getMessages(), 400);

        try {
            $user = new User();

            $user->email = $request->email;
            $user->first_name = $request->firstName;
            $user->last_name = $request->lastName;
            $user->password = Hash::make($request->password);
            $user->card_id = $request->cardId;
            $user->is_underage = $request->isUnderage;
            $user->phone = $request->phone;
            $user->cell_phone = $request->cellPhone;
            $user->municipality_id = $request->municipalityId;
            $user->address = $request->address;

            $user->save();

            $token = $user->createToken(Carbon::now())->plainTextToken;
            $userData = UserResource::make($user)->format($request);

            $data = [
                'user' => $userData,
                'meta' => [
                    'type' => 'Bearer',
                    'access_token' => $token,
                    'message' => 'success'
                ]
            ];

            if ($user->id)
                return json_success($data, 201);
            else
                return json_errors(['message' => 'Error creating user'], 500);
        } catch (\Throwable $th) {
            dump($th);
            Log::error($th);
            return json_errors(['message' => 'Error al crear el usuario'], 500);
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
        try {
            $user = User::find($id);
            if ($user)
                return json_success(UserResource::make($user), 200);
            else
                return json_errors(['message' => 'User not found'], 404);
        } catch (\Throwable $th) {
            Log::error($th);
            return json_errors(['message' => $th->getMessage()], 500);
        }
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
