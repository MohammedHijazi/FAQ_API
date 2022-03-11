<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

class QuestionsController extends Controller
{


    public function index($id)
    {
        $category=Category::where('id',$id)->first();
        if(is_null($category)){
            return response()->json([
                'error' => true,
                'message' => 'Category not found'
            ], 404);
        }
        if($category->user_id != auth()->user()->id){
            return response()->json(['error'=> true,
                'message' => "You cannot access this category" ], 403);
        }
        $questions=$category->questions;

        return Response::json($questions,200);
    }

    public function store(Request $request)
    {
        Gate::authorize('active');
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'details' => 'string|required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20498',
            //'youtube_link' => 'sometimes|required|url',
            //'font_size' => 'sometimes|required|numeric',
            'alignment' => 'sometimes|required|string',
            'color' => 'sometimes|required|string',
            //'url' => 'sometimes|required|url',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 401);
        }

        $question = new  Question();
        if ($request->hasFile('picture')) {
            $file=$request->file('picture');
            $image_path=$file->store('uploads','public');
            $question->image_path=$image_path;
        }
        $question->user_id=auth()->user()->id;
        $question->title =  $request->title;
        $question->details =  $request->details;
        $question->youtube_link =  $request->youtube_link;
        $question->font_size =  $request->font_size;
        $question->algiment =  $request->algiment;
        $question->color =  $request->color;
        $question->url =  $request->url;
        $question->category_id =  $request->category_id;

        $cat=Category::where('id',$request->category_id)->first();
        if($cat->user_id != auth()->user()->id){
            return response()->json(['error'=> true,
                'message' => "Category does not exist" ], 403);
        }
        $question->save();

        return response()->json([
            'message' => 'A new question has been added successfully'
        ], 201);
    }


    public function update(Request $request, $id)
    {
        Gate::authorize('active');
        $question  =  Question::find($id);
        if(is_null($question)){
            return response()->json([
                'error' => true,
                'message' => 'Question not found'
            ], 404);
        }

        if($question->user_id != auth()->user()->id){
            return Response::json('Question does not exist',404);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'details' => 'string|required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20498',
            //'youtube_link' => 'sometimes|required|url',
            //'font_size' => 'sometimes|required|numeric',
            'alignment' => 'sometimes|required|string',
            //'color' => 'sometimes|required|string',
            //'url' => 'sometimes|required|url',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()
            ], 401);
        }

        if($request->hasFile('picture')) {
            $oldFile = asset('storage/' . $question->image_path);
            if ($oldFile) {
                Storage::disk('public')->delete($question->image_path);
            }
            $newFile=$request->file('picture');
            $image_path=$newFile->store('uploads','public');
            $question->image_path = $image_path;
        }
        $question->title =  $request->title;
        $question->details =  $request->details;
        $question->youtube_link =  $request->youtube_link;
        $question->font_size =  $request->font_size;
        $question->algiment =  $request->algiment;
        $question->color =  $request->color;
        $question->url =  $request->url;
        $question->category_id =  $request->category_id;

        $cat=Category::where('id',$request->category_id)->first();
        if($cat->user_id != auth()->user()->id){
            return response()->json(['error'=> true,
                'message' => "Category does not exist" ], 403);
        }

        $question->save();
        return response()->json([
            'error' => false,
            'message' => 'The Question has been updates successfully'
        ], 200);
    }


    public function destroy($id)
    {
        Gate::authorize('active');
        $question=Question::find($id);
        if(is_null($question)){
            return response()->json([
                'error' => true,
                'message' => 'Question not found'
            ], 404);
        }

        if($question->user_id != auth()->user()->id){
            return response()->json(['error'=> true,
                'message' => "Question does not exist" ], 403);
        }
        $question->delete();
        Storage::disk('public')->delete($question->image_path);
        return response()->json([
            'error' => false,
            'message' => 'The Question has been deleted successfully'
        ], 200);


    }
}
