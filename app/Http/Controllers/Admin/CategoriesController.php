<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CategoriesController extends Controller
{

    public function index()
    {
        Gate::authorize('active');
        $categories=Category::where('user_id','=',Auth::id())->get();
        return view('admin.categories.index',compact('categories'));
    }


    public function create()
    {
        Gate::authorize('active');
        $fields = Schema::getColumnListing('questions');
        unset($fields[0]);

        return view('admin.categories.create',compact('fields'));
    }


    public function store(Request $request)
    {
        Gate::authorize('active');
        $request->validate([
            'name' => 'required|string|max:255',
            'fields' => 'required',
        ]);
        $user_id=Auth::id();

        $user_cats=Category::where('user_id',$user_id)->get();
        foreach ($user_cats as $cat){
            if($request->name==$cat->name){
                return redirect()->back()->with('error','Category name already exist');
                break;
            }
        }

        $category = new  Category();
        $category->user_id=Auth::id();
        $category->name =  $request->name;
        $fields=implode(",",$request->fields);
        $category->fields =$fields ;

        $category->save();

        return redirect(route('categories.index'))->with('success', 'A new type has been successfully added');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        Gate::authorize('active');
        $fields = Schema::getColumnListing('questions');
        $category  =  Category::where( 'id',$id)->first();
        $category->fields = explode(',',   $category->fields);
        unset($fields[0]);
        return view('admin.categories.edit',compact('fields', 'category'));
    }


    public function update(Request $request, $id)
    {
        Gate::authorize('active');
        $category  =  Category::where( 'id', $id)->first();
        $request->validate([
            'name' => 'required|string',
            'fields' => 'required',
        ]);

        $user_id=Auth::id();
        $user_cats=Category::where('user_id',$user_id)->get();
        foreach ($user_cats as $cat){
            if($request->name==$cat->name){
                return redirect()->back()->with('error','Category name already exist');
                break;
            }
        }

        $category->name =  $request->name;
        $category->fields =  implode(",",$request->fields);
        $category->save();
        return redirect(route('categories.index'))->with('success', 'Category updated successfully');
    }


    public function destroy($id)
    {
        Gate::authorize('active');
        Category::destroy($id);
        return redirect()->route('categories.index')
            ->with('success', 'Category deleted');
    }
}
