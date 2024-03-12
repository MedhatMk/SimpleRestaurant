<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class MenuController extends Controller
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
    public function adminHome(){
        return view('home');
    }

//    public function index(Request $request){
//        $menu = Item::sortable()->paginate(1);
//         $cats = Category::all();
//        return view('admin.menu.index', ['menu'=>$menu , 'cats'=>$cats]);
//    }

    public function filterByCategory(Request $request)
    {

        $category  = $request->query('category','');
        $items = Item::when($category, function ($query, $category){
            return $query->where('category_id',$category);
        })->sortable()->paginate(2);
         $cats = Category::all();
        return view('admin.menu.index',['menu'=>$items,'cats'=>$cats]);

    }

    public function create(){
        $categories = Category::all();
        return view('admin.menu.edit', ['categories'=>$categories]);
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
        return redirect('/admin/items',);
    }
    function edit($id)
    {
        $item = Item::with('category')->find($id);
        if ($item){
            return view('admin.menu.edit', ['item'=>$item, 'categories'=>Category::all()]);
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
            return redirect('/admin/items');
        }

        return response()->json(['message'=>['Item Not found']]);
    }
        function destroy($id)
    {
        $item = Item::with('category')->find($id);
        if ($item){
            $item->delete();
            session()->flash('success', 'Item Deleted successfully!');
            return redirect('/admin/items');
        }
        return response()->json(['message'=>['Item Not found']]);
        }

}
