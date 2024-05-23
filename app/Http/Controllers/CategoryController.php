<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::paginate(10);
        return view('pages.categories.index', compact('categories'));
    }

    // create
    public function create(){
        return view('pages.categories.create');
    }

    // add data
    public function store(Request $request){
        // validate
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // add data
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/categories', $category->id . "." . $image->getClientOriginalExtension());
            $category->image = 'storage/categories/' .$category->id . "." . $image->getClientOriginalExtension();
            $category->save();
        }

        return redirect()->route('categories.index')->with('success', 'New Category Has Been Added');
    }

    //show
    public function show($id){
        return view('pages.categories.show');
    }

    //edit
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('pages.categories.edit', compact('category'));
    }

    //update
    public function update(Request $request, $id){
        //validate
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // update data by id
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image->storeAs('public/categoriess', $category->id . "." . $image->getClientOriginalExtension());
            $category->image = 'storage/categoriess/' .$category->id . "." . $image->getClientOriginalExtension();
            $category->save();
        }

        return redirect()->route('categories.index')->with('success', 'category Has Been Updated');
    }

    //delete
    public function destroy($id){
        // delete by id
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'category Has Been Deleted');
    }

}
