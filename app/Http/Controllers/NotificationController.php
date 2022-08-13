<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $notification = Notification::paginate(15) ?? [];
            if ($notification->isEmpty())
                return json_success(['data' => []]);

            $paginate = [
                'total' => $notification->total(),
                'perPage' => $notification->perPage(),
                'currentPage' => $notification->currentPage(),
                'previusPageUrl' => $notification->previousPageUrl(),
                'nextPageUrl' => $notification->nextPageUrl(),
                'pageName' => $notification->getPageName(),
            ];


            return json_success(NotificationResource::collection($notification, $paginate));
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
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);

            if ($validator->fails())
                return json_errors($validator->errors()->getMessages(), 400);

            $user = auth()->user();

            $notification = Notification::create([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            if ($notification->id)
                return json_success(NotificationResource::make($notification), 200);
            else
                return json_errors(['message' => 'Notification not saved'], 400);
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
