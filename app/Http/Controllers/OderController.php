<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id'=>$request->get('user_id'),
            'order_status'=>$request->get('order_status'),
            'order_price'=>$request->get('order_price'),
            'order_date'=>$request->get('order_date'),
            'delivery_address'=>$request->get('delivery_address'),
            'facturation_address'=>$request->get('facturation_address'),
        ]);
        return $order;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if ($order){
            $order->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
