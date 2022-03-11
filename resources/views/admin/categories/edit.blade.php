@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Category </div>

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

                                        @if (\Session::has('error'))
                                            <div class="alert alert-danger">
                                                <a class="panel-close close" data-dismiss="alert">×</a>
                                                <i class="fa fa-coffee"></i>
                                                {!! \Session::get('error') !!}
                                            </div>
                                        @endif


                                    <form method="post" action="{{ route('categories.update',$category->id ) }}">
                                        @method('put')
                                        @csrf
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ !empty( old('name')) ? old('name') : $category->name }}" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="fields" class="col-md-4 col-form-label text-md-right">{{ __('Display fields') }}</label>

                                            <div class="col-md-6">
                                                <select id="fields" name="fields[]"  class="form-control @error('fields') is-invalid @enderror" multiple>
                                                    @foreach ($fields as $field)
                                                        @if (in_array($field,  $category->fields ))
                                                            <option selected value="{{$field}}">{{$field}}</option>

                                                        @else
                                                            <option  value="{{$field}}">{{$field}}</option>

                                                        @endif
                                                    @endforeach

                                                </select>


                                                @error('fields')
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
