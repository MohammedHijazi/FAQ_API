@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Question </div>

                    <div class="card-body">

                        <div class="container bootstrap snippets bootdey">

                            <div class="row">
                                <!-- left column -->

                                <!-- edit form column -->
                                <div class="col-md-12 personal-info">
                                    @if (\Session::has('success'))
                                        <div class="alert alert-info alert-dismissable">
                                            <a class="panel-close close" data-dismiss="alert">×</a>
                                            <i class="fa fa-coffee"></i>
                                            {!! \Session::get('success') !!}
                                        </div>
                                    @endif



                                    <form method="post" action="{{route('questions.update',$question->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')

                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('title') }}</label>

                                            <div class="col-md-6">
                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ empty(old('title'))? $question->title : old('title') }}"  autocomplete="title" autofocus>

                                                @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="details" class="col-md-4 col-form-label text-md-right">{{ __('details') }}</label>

                                            <div class="col-md-6">
                                                <textarea id="details" type="text" class="form-control @error('details') is-invalid @enderror" name="details"   autocomplete="details" autofocus style="height: 125px;">{{ empty(old('details'))? $question->details : old('details') }}</textarea>

                                                @error('details')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="picture" class="col-md-4 col-form-label text-md-right">{{ __('picture') }}</label>

                                            <div class="col-md-6">
                                                <img id="profile_image" width="320" height="150" src="{{asset('storage/'.$question->image_path )}}" class="thumb-lg img-circle img-thumbnail" alt="_photo" >
                                                <br>
                                                <br>
                                                <input id="picture" type="file" class="form-control filestyle @error('picture') is-invalid @enderror"  name="picture" value="{{ old('picture') }}"  autocomplete="picture" autofocus  data-input="false" accept="image/*"  tabindex="-1" style="height:50px" >


                                                @error('picture')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="youtube_link" class="col-md-4 col-form-label text-md-right">{{ __('youtube link') }}</label>

                                            <div class="col-md-6">
                                                <input id="youtube_link" type="url" class="form-control @error('youtube_link') is-invalid @enderror" name="youtube_link" value="{{ empty(old('youtube_link'))? $question->youtube_link : old('youtube_link') }}"  autocomplete="picture" autofocus>

                                                @error('youtube_link')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="font_size" class="col-md-4 col-form-label text-md-right">{{ __('font size') }}</label>

                                            <div class="col-md-6">
                                                <input id="font_size" type="number" class="form-control @error('font_size') is-invalid @enderror" name="font_size" value="{{ empty(old('font_size'))? $question->font_size : old('font_size') }}"  autocomplete="picture" autofocus>

                                                @error('font_size')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="algiment" class="col-md-4 col-form-label text-md-right">{{ __('algiment') }}</label>

                                            <div class="col-md-6">
                                                <input id="algiment" type="text" class="form-control @error('algiment') is-invalid @enderror" name="algiment" value="{{ empty(old('algiment'))? $question->algiment : old('algiment') }}"  autocomplete="algiment" autofocus>

                                                @error('algiment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('color') }}</label>

                                            <div class="col-md-6">
                                                <input id="color" type="color" class="form-control @error('color') is-invalid @enderror" name="color" value="{{ empty(old('color'))? $question->color : old('color') }}"  autocomplete="color" autofocus>

                                                @error('color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('url') }}</label>

                                            <div class="col-md-6">
                                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ empty(old('url'))? $question->url : old('url') }}"  autocomplete="url" autofocus>

                                                @error('url')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="type_id" class="col-md-4 col-form-label text-md-right">{{ __('type') }}</label>

                                            <div class="col-md-6">
                                                <select id="type_id" required name="type_id"  class="form-control @error('type_id') is-invalid @enderror" >
                                                    @foreach ($categories as $category)
                                                        <option  {{$question->category_id == $category->id ? 'selected' : ''}}  value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach

                                                </select>


                                                @error('type_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
