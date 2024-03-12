<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function getAllOrders(){
        $orders = Order::all();
        return response()->json(['orders'=>$orders], '200');
    }
    public function getOrderById($id){
        $order = Order::find($id);
        if (!$order) return response()->json(['message'=>'Order not found'], '404');
        return response()->json(['order'=>$order], '200');
    }
    public function createOrder(Request $request){
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->save();
        return response()->json(['message'=>'Order created','order'=>$order], '200');
    }
    public function update(Request $request, $id){
        $order = Order::find($id);
        if (!$order) return response()->json(['message'=>'Order not found'], '404');

        $order->status = $request->status;
        $order->save();
        return response()->json(['message' => 'Order status updated', 'order' => $order], '200');
    }
    public function showOrderItems($id){
        $order = Order::find($id);
        if (!$order) return response()->json(['message'=>'Order not found'], '404');

        $items = $order->items;
        return response()->json(['items'=>$items], '200');
    }
    public function addOrderItem(Request $request){
        $order = Order::find($request->order_id);
        if (!$order) return response()->json(['message'=>'Order not found'], '404');

        $order->items()->attach($request->item_id, ['quantity' => $request->quantity]);

        return response()->json(['message'=>'Item added to order'], '200');
    }

    public function removeOrderItem(Request $request){
        $order = Order::find($request->order_id);
        $order->items()->detach($request->item_id);
        if ($order->items->count() == 0) $order->delete();

        return response()->json(['message'=>'Item removed from order'], '200');
    }
    public function destroy($id){
        $order = Order::find($id);
        if (!$order) return response()->json(['message'=>'Order not found'], '404');

        $order->delete();
        return response()->json(['message'=>'Order deleted'], '200');
    }

}
