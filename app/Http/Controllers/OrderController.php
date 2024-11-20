<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return new OrderCollection(Order::all());
    }

    public function show(Request $request, Order $order)
    {
        return new OrderResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        $order = Order::create($validated);

        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {   
        $validated = $request->validated();

        $order->updated($validated);

        return new OrderResource($order);

    }
    public function destroy(Request $request,Order $order)
    {
        $order->delete();

        return response()->noContent();
    }
}
