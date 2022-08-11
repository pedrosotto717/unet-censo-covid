<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $reqAuth = $request->header('Authorization');

        if ($reqAuth == null)
            return json_errors(['message' => 'Bad Request'], 400);

        [$type, $authorization] = explode(' ', $reqAuth);

        if ($type != 'Basic')
            return json_errors(['message' => 'Bad Request'], 400);

        list($email, $password) = explode(':', base64_decode($authorization));


        if (!Auth::attempt(['email' => $email, 'password' => $password]))
            return json_errors(['auth' => 'Unauthorized, email or password Invalid'], 401);

        $dataUser = UserResource::make($request->user())->format($request);
        $token = $request->user()->createToken(Carbon::now())->plainTextToken;

        $data = [
            'user' => $dataUser,
            'meta' => [
                'type' => 'Bearer',
                'access_token' => $token,
                'message' => 'success'
            ]
        ];

        return json_success($data, 200);
    }

    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return json_success([
            'data' => [
                'message' => 'Successfully logged out'
            ]
        ]);
    }
}
