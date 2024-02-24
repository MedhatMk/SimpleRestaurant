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
    public function index(){
        return view('home');
    }

    public function adminHome(){
        $menu = Item::all();
        return view('admin.home', ['menu'=>$menu]);
    }


    public function create(){
        $categories = Category::all();
        return view('admin.edite', ['categories'=>$categories]);
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
        session()->flash('success', 'Item stored successfully!');
        return redirect('/admin/home',);
    }
    function edit($id)
    {
        $item = Item::with('category')->find($id);
        $categories = Category::all();
        if ($item){
            return view('admin.edite', ['item'=>$item, 'categories'=>$categories]);
        }

        return  session()->flash('success', 'Item Not found!');
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
        session()->flash('success', 'Item updated successfully!');
            return redirect('/admin/home');
        }

        return response()->json(['message'=>['Item Not found']]);
    }
        function destroy($id)
    {
        $item = Item::with('category')->find($id);
        if ($item){
            $item->delete();
            session()->flash('success', 'Item Deleted successfully!');
            return redirect('/admin/home');
        }
        return response()->json(['message'=>['Item Not found']]);
        }

}
