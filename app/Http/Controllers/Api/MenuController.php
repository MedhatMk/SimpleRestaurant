<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;

class MenuController extends Controller
{
    function index()
    {
        $items = Item::with('category')->get();
        if (!$items) return response()->json(['message'=>['Items Not found']]);

        return response()->json(['data'=>[$items]]);
    }
    function show($id)
    {
        $item = Item::with('category')->find($id);
        if (!$item) return response()->json(['message'=>['Item Not found']]);

        return response()->json(['message'=>['Item Not found']]);

    }

    function store()
    {
        $data = request()->all();
        $item = new Item([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'price'=>$data['price'],
            'category_id'=>$data['category_id'],

        ]);
        $item->save();

        return response()->json(['message'=>['Item Created Successfully']]);
    }

        function update($id)
    {
        $data = request()->all();
        $item = Item::find($id);
        if ($item){
                        $item->update([
            'name'=>$data['name'],
            'description'=>$data['description'],
            'price'=>$data['price'],
            'category_id'=>$data['category_id'],

        ]);
        $item->save();
        return response()->json(['message'=>['Item updated Successfully']]);
        }

        return response()->json(['message'=>['Item Not found']]);
    }


    function destroy($id)
    {
        $item = Item::with('category')->find($id);
        if ($item){
            $item->delete();
            return response()->json(['message'=>['Item deleted Successfully']]);
        }
        return response()->json(['message'=>['Item Not found']]);
        }
}
