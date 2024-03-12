<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Adhome(){
        return view('home');
    }

    public function index(){
        $cats = Category::all();
        return view('admin.category.index', ['cats'=>$cats]);
    }


    public function create(){
        return view('admin.category.edit');
    }
    function store()
    {
        $data = request()->all();
        $item = new Category([
            'name'=>$data['name'],
        ]);
        $item->save();
        session()->flash('success', 'Category stored successfully!');
        return redirect('/admin/categories',);
    }
    function edit($id)
    {
        $item = Category::find($id);
        if ($item){
            return view('admin.category.edit', ['item'=>$item]);
        }

        return  session()->flash('success', 'Category Not found!');
    }
    function update($id)
    {
        $data = request()->all();
        $item = Category::find($id);
        if ($item){
             $item->update([
            'name'=>$data['name'],

        ]);
        $item->save();
        session()->flash('success', 'Category updated successfully!');
            return redirect('/admin/categories');
        }

        return response()->json(['message'=>['Category Not found']]);
    }
        function destroy($id)
    {
        $item = Category::find($id);
        if ($item){
            $item->delete();
            session()->flash('success', 'Category Deleted successfully!');
            return redirect('/admin/categories');
        }
        return response()->json(['message'=>['Category Not found']]);
        }


}
