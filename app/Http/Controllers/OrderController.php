<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
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
    public function store(StoreOrderRequest $request)
    {
        $validatedData = $request->validated();

        $total_price = 0;
        // * for each product in the order we calcultate the total price
        foreach ($validatedData['products'] as $productData) {
            $total_price += $productData['product_unit_price'] * $productData['quantity'];
        }
    
        // * create the order with the total price in the order_price
        $order = Order::create([
            'user_id' => $validatedData['user_id'],
            'order_status' => $validatedData['order_status'],
            'order_date' => $validatedData['order_date'],
            'delivery_address' => $validatedData['delivery_address'],
            'facturation_address' => $validatedData['facturation_address'],
            'order_price' => $total_price,
        ]);

        // * Attach products to orders in the orders_products table
        foreach ($validatedData['products'] as $productData) {
            $order->products()->attach($productData['product_id'], [
                'product_name' => $productData['product_name'],
                'product_unit_price' => $productData['product_unit_price'],
                'quantity' => $productData['quantity'],
            ]);
        }
    
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
    public function update(StoreOrderRequest $request, Order $order)
    {
        $this->authorize('update', $order);
        if ($order) {
            $order->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $this->authorize('destroy', $order);
        if ($order) {
            $order->delete($order);
        }
    }

    public function searchByUser($userId)
    {

        $orders = Order::whereHas('users', function (Builder $query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return $orders;
    }
}
