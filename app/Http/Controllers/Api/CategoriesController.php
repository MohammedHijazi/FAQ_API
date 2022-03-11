<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;
use function PHPUnit\Framework\isNull;

class CategoriesController extends Controller
{

    public function index()
    {
        Gate::authorize('active');
        $user_id=auth()->user()->id;
        $categories=Category::where('user_id',$user_id)->get();

        return Response::json($categories,200);
    }


    public function store(Request $request)
    {
        Gate::authorize('active');
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'fields' => 'required|array',
        ]);

        if($validator->fails()){
            return response()->json([
                'error'=> true,
                'message' => $validator->errors() ], 401);
        }

        $user_id=auth()->user()->id;
        $user_cats=Category::where('user_id',$user_id)->get();
        foreach ($user_cats as $cat){
            if($request->name==$cat->name){
                return Response::json('category name already exists',403);
                break;
            }
        }

        $category = new  Category();
        $category->user_id=auth()->user()->id;
        $category->name =  $request->name;
        $category->fields =  implode(",",$request->fields);

        $category->save();

        return response()->json([
            'error'=> false,
            'message' => 'New Category has been added successfully' ], 201);
    }


    public function update(Request $request, $id)
    {
        Gate::authorize('active');

        $category=Category::where('id',$id)->first();


        if(is_null($category)){
            return Response::json('category does not exist',404);
        }
        if($category->user_id != auth()->user()->id){
            return response()->json(['error'=> true,
                'message' => "category does not exist" ], 403);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'fields' => 'required|array',
        ]);


        if($validator->fails()){
            return response()->json(['error'=> true,
                'message' => $validator->errors() ], 401);
        }

        $user_id=auth()->user()->id;
        $user_cats=Category::where('user_id',$user_id)->get();
        foreach ($user_cats as $cat){
            if($request->name==$cat->name){
                return Response::json('category name already exists',403);
                break;
            }
        }
        if($request->name){
            $category->name =  $request->name;
        }

        $category->fields =  implode(",",$request->fields);
        $category->save();

        return response()->json(['error'=> false,
            'message' => 'Category has been updates successfully' ], 200);
    }


    public function destroy($id)
    {
        Gate::authorize('active');
        $category=Category::find($id);

        if(is_null($category)){
            return Response::json('category does not exist',404);
        }
        if($category->user_id != auth()->user()->id){
            return response()->json(['error'=> true,
                'message' => "category does not exist" ], 403);
        }
        $category->delete();
        return Response::json('category has been deleted successfully',200);
    }
}
