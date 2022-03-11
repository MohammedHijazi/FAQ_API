@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Question </div>

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


                                    <form method="post" action="{{route('questions.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('title') }}</label>

                                            <div class="col-md-6">
                                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}"  autocomplete="title" autofocus>

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
                                                <textarea id="details" type="text" class="form-control @error('details') is-invalid @enderror" name="details"   autocomplete="details" autofocus style="height: 125px;">{{ old('details') }}</textarea>

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
                                                <input id="picture" type="file" class="form-control @error('picture') is-invalid @enderror" name="picture" value="{{ old('picture') }}"  autocomplete="picture" autofocus>

                                                @error('picture')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('url') }}</label>

                                            <div class="col-md-6">
                                                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') }}"  autocomplete="url" autofocus>

                                                @error('url')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="type_id" class="col-md-4 col-form-label text-md-right">{{ __('category_id') }}</label>

                                            <div class="col-md-6">
                                                <select id="type_id" required name="type_id"  class="form-control @error('type_id') is-invalid @enderror" >
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
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
