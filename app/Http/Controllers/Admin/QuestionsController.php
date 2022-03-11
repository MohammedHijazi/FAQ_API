<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class QuestionsController extends Controller
{

    public function index()
    {
        Gate::authorize('active');
        $questions = Question::where('user_id','=',Auth::id())->get();
        return view('admin.questions.index', compact('questions'));
    }


    public function create()
    {
        Gate::authorize('active');
        $categories = Category::where('user_id','=',Auth::id())->get();

        return view('admin.questions.create',compact('categories'));
    }


    public function store(Request $request)
    {
        Gate::authorize('active');
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'string|required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20498',
            //'youtube_link' => 'sometimes|required|url',
            //'font_size' => 'sometimes|required|numeric',
            'alignment' => 'sometimes|required|string',
            'color' => 'sometimes|required|string',
            //'url' => 'sometimes|required|url',
            'type_id' => 'required|numeric|exists:categories,id',
        ]);

        $question = new  Question();

        $question->user_id=Auth::id();
        $question->title =  $request->title;
        $question->details =  $request->details;
        $question->youtube_link =  $request->youtube_link;
        $question->font_size =  $request->font_size;
        $question->algiment =  $request->algiment;
        $question->color =  $request->color;
        $question->url =  $request->url;
        $question->category_id =  $request->type_id;
        if($request->hasFile('picture'))
        {
            $file=$request->file('picture');
            $image_path=$file->store('uploads','public');
            $question->image_path=$image_path;
        }
        $question->save();
        return redirect(route('questions.index'))->with('success', 'A new rosters has been added successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        Gate::authorize('active');
        $categories = Category::where('user_id','=',Auth::id())->get();
        $question  =  Question::where( 'id',$id)->first();
        return view('admin.questions.edit',compact('question', 'categories'));
    }


    public function update(Request $request, $id)
    {
        Gate::authorize('active');
        $question  =  Question::where('id', $id)->first();
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'string|required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20498',
            //'youtube_link' => 'sometimes|required|url',
            //'font_size' => 'sometimes|required|numeric',
            'alignment' => 'sometimes|required|string',
            'color' => 'sometimes|required|string',
            //'url' => 'sometimes|required|url',
            'type_id' => 'required|numeric|exists:categories,id',
        ]);
        if($request->hasFile('picture')){
            $oldFile = asset('storage/'.$question->image_path);
            if($oldFile) {
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
        $question->category_id= $request->type_id;
        $question->save();
        return redirect(route('questions.index'))->with('success', 'The Question has been edited successfully');
    }


    public function destroy($id)
    {
        Gate::authorize('active');
        $question=Question::findOrFail($id);
        $question->delete();
        Storage::disk('public')->delete($question->image_path);
        return redirect()->route('questions.index')
            ->with('success', 'Question deleted');
    }
}
