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
    public function index($date)
    {
        $orders = Order::with('orderDetails.menu')->whereDate('created_at', $date != "null" ? $date : Carbon::now())->get();

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
}
