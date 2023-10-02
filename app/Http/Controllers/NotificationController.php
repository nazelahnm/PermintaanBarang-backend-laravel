<?php

namespace App\Http\Controllers;

use App\Models\notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            $notifications = Notification::where('userId', $id)
                ->whereBetween('created_at', [
                    Carbon::now()->subDays(7)->toDateTimeString(),
                    Carbon::now()->toDateTimeString(),
                ])
                ->orderBy('created_at', 'DESC')
                ->orderBy('isOpen', 'ASC')
                ->get();

            return response()->json([
                'data' => $notifications,
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $notification = Notification::where('id', $id)->first();
            return response()->json([
                'data' => $notification,
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $notifUpdate = Notification::where('id', $id)->update([
            'isOpen' => 1,
        ]);

        $notificationFound = Notification::where('id', $id)->first();

        return response()->json([
            'message' => 'Notification updated',
            'data' => $notificationFound,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
