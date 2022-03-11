@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style=" display: flex; justify-content: space-between; align-content: center; align-items: center; ">Manage Questions

                        <a class="btn btn-primary" href="{{route('questions.create')}}" role="button">ADD</a>

                    </div>

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
                                    <div class="panel panel-border panel-primary">
                                        <div class="panel-heading">
                                        </div>
                                        <div class="panel-body table-responsive">
                                            <table id="datatable-fixed-header"
                                                   class="table table-striped table-bordered success">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Details </th>
                                                    <th>Picture </th>
                                                    <th>URL </th>
                                                    <th>Category </th>
                                                    <th>Options </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($questions as $question)
                                                    <tr>
                                                        <td>{{$question->id}} </td>
                                                        <td>{{$question->title}}</td>
                                                        <td style=" max-width: 200px; ">{{$question->details}}</td>
                                                        <td>
                                                            <img width="100" height="100" src="{{asset('storage/'.$question->image_path) }}"></td>

                                                        <td style=" max-width: 200px; "><a href="{{$question->url}}" target="_blank"> {{$question->url}}</a></td>
                                                        <td>{{$question->category->name}}</td>

                                                        <td>
                                                            <form method="post" action="{{route('questions.destroy',$question->id)}}" style=" display: inline-block; ">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                            </form>

                                                            <a href="{{route('questions.edit',$question->id)}}"  class="btn btn-outline-primary btn-sm">Edit</a>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
