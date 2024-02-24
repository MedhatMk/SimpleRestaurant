<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    function index()
    {
        $categories = Category::all();
        return response()->json(['data'=>[$categories]]);
    }
    function show($id)
    {
        $category = Category::find($id);
        If($category){
            return response()->json(['data'=>[$category]]);
        }
        return response()->json(['message'=>['Category Not found']]);

    }

    function store()
    {
        $data = request()->all();
        $category = new Category([
            'name'=>$data['name'],
        ]);

        $category->save();
        return response()->json(['message'=>['Category Created Successfully']]);
    }

        function update($id)
    {
        $data = request()->all();
        $category = Category::find($id);
        if ($category){
            $category->update([
            'name'=>$data['name'],
        ]);

        $category->save();
        return redirect('/category');
        }

        return response()->json(['message'=>['Category Not found']]);
    }


    function destroy($id)
    {
        $category = Category::find($id);
        if ($category){
            $category->delete();
            return response()->json(['message'=>['Category deleted Successfully']]);
        }
        return response()->json(['message'=>['Category Not found']]);
        }
}
