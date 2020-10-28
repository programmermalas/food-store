<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('orderDetails.menu')->whereDate('created_at', Carbon::now())->get();

        return response()->json($orders, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sub_total' => 'required|numeric',
            'tax' => 'required|numeric',
            'cash' => 'required|numeric',
            'details' => 'required|array',
        ]);

        $order = Order::create([
            'name' => $request->name,
            'sub_total' => $request->sub_total,
            'tax' => $request->tax,
            'cash' => $request->cash,
        ]);

        foreach ($request->details as  $detail) {
            OrderDetail::create([
                'order_id' => $order->id,
                'menu_id' => $detail['id'],
                'quantity' => $detail['quantity'],
                'total' => $detail['quantity'] * $detail['price'],
            ]);
        }

        $order->load('orderDetails.menu');

        return response()->json($order, 201);
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
