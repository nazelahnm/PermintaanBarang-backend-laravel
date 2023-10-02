<?php

namespace App\Http\Controllers;

use App\Models\notification;
use App\Models\order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = order::with("user", "category")->orderBy("created_at", "DESC")->get();
        return response()->json(
             $order);
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
        $validateData = $request->validate([
            "userId" => "required",
            "categoryId" => "required",
            "subCategoryId" => "required",
            "namaBarang" => "required",
            "date" => "required",
            "amount" => "required",
        ]);

        $order = order::create([
            "userId" => $validateData["userId"],
            "categoryId" => $validateData["categoryId"],
            "subCategoryId" => $validateData["subCategoryId"],
            "namaBarang" => $validateData["namaBarang"],
            "date" => $validateData["date"],
            "amount" => $validateData["amount"],
        ]);
        return response()->json([
            "message" => "order created",
            "data" => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = order::with("user", "category", "subCategory")->where("id", $id)->first();
        if ($order) {
            return response()->json([
                $order
            ]);
        } else {
            return response()->json([
                "message" => "order not found",
                "data" => null
            ], 404);
        }
    }

    public function showMobile($id)
    {
        $order = order::find($id);
        if ($order) {
            return response()->json([
                "message" => "Detail of order",
                "data" => $order
            ]);
        } else {
            return response()->json([
                "message" => "order not found",
                "data" => null
            ], 404);
        }
    }

    public function countByStatus(Request $request)
    {
        $countDone = order::where("statusOrder", "Done")->count();
        $countOnProgress = order::where("statusOrder", "On Progress")->count();

        return response()->json([

                "done" => $countDone,
                "onProgress" => $countOnProgress

        ]);
    }

    public function getByStatus()
    {
        try {
            $orders = Order::select()
                ->orderBy('created_at', 'DESC')
                ->where('statusOrder', '!=', 'Done')
                ->with([
                    'user' => function ($query) {
                        $query->select('id', 'username', 'email');
                    },
                    'category' => function ($query) {
                        $query->select('id', 'name');
                    },
                ])
                ->get();

            return response()->json($orders);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    public function getHistory(Request $request, $month)
    {

        try {

            $startOfMonth = null;
            $endOfMonth = null;

            if ($month) {
                $startOfMonth = Carbon::parse($month)->startOfMonth()->format('Y-m-d H:i:s');
                $endOfMonth = Carbon::parse($month)->endOfMonth()->format('Y-m-d H:i:s');
            } else {
                $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d H:i:s');
                $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d H:i:s');
            }


            $userIds = DB::table('orders')
            ->select('userId', DB::raw('MAX(updated_at) as last_updated'))
            ->where('statusOrder', 'Done')
            ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
            ->groupBy('userId')
            ->get();


            $listUserId = $userIds->pluck('userId')->toArray();

            // Sum amount from orders marked as "Done"
            $amount = DB::table('orders')
                ->where('statusOrder', 'Done')
                ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            $data = [];
            foreach ($listUserId as $userId) {
                $orders = DB::table('orders')
                    ->where('userId', $userId)
                    ->where('statusOrder', 'Done')
                    ->sum('amount');

                $user = User::find($userId, ['id', 'username']);

                $data[] = [
                    'userId' => $user->id,
                    'userName' => $user->username,
                    'amount' => $orders,
                ];
            }

            $listOrder = DB::table('orders')
                ->where('statusOrder', 'Done')
                ->whereBetween('updated_at', [$startOfMonth, $endOfMonth])
                ->get();

            return response()->json([
                'userLength' => count($userIds),
                'amount' => $amount ? $amount : 0,
                'data' => $data,
                'listData' => $listOrder,
            ]);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    public function showHistoryByUser($id)
    {
        try {
            $userFound = User::find($id);
            $orders = order::with("user", "category", "subCategory")->where("userId", $id)->where("statusOrder", "Done")->orderBy("created_at", "DESC")->get();
            if ($userFound) {
                return response()->json([
                    "user" => $userFound,
                    "data" => $orders
                ]);
            } else {
                return response()->json([
                    "message" => "order not found",
                    "data" => null
                ], 404);
            }
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $statusRequest = $request->statusRequest;
            $orderFound = order::find($id);

            if (!$orderFound) {
                return response()->json([
                    "message" => "order not found",
                    "data" => null
                ], 404);
            }

            $orderFound->statusRequest = $statusRequest;

            if ($statusRequest == "Reject") {
                $orderFound->statusOrder = "Done";
            } else {
                $orderFound->statusOrder = "On Progress";
            }

            $orderFound->save();


            $notification = new notification([
                'status' => 'unread',
                'userId' => $orderFound->userId,
                'orderId' => $orderFound->id,
            ]);
            $notification->save();

            return response()->json([
                'statusRequest' => $statusRequest,
                'orderFound' => $orderFound,
                'message' => 'Data has been updated',
            ], 200);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    public function ambilBarang($id)
    {
        $orders = order::find($id);
        $orders->statusOrder = "Done";
        $orders->save();

        return response()->json([
            "message" => "order updated",
            "data" => $orders
        ]);
    }

    public function dataExport(Request $request, $id, $month)
    {
        try {
            $startOfMonth = null;
            $endOfMonth = null;
            if($month){
                $startOfMonth = Carbon::parse($month)->startOfMonth()->format('Y-m-d');
                $endOfMonth = Carbon::parse($month)->endOfMonth()->format('Y-m-d');
            }
            $dataFound = DB::table('orders')
                ->where('userId', $id)
                ->where('statusOrder', 'Done')
                ->where('statusRequest', 'Accept')
                ->whereBetween('date', [$startOfMonth, $endOfMonth])
                ->get();

            $userFound = User::find($id);

            return response()->json(['dataFound' => $dataFound, 'userFound' => $userFound]);
        } catch (\Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = order::find($id);
        if (!$order) {
            return response()->json([
                "message" => "order not found",
                "data" => null
            ], 404);
        }

        $order->delete();
        return response()->json([
            "message" => "order deleted",
            "data" => $order
        ]);
    }
}
