@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="width: 900px">
                    <div class="card-header" style=" display: flex; justify-content: space-between; align-content: center; align-items: center;">Manage Categories

                        <a class="btn btn-primary" href="{{route('categories.create')}}" role="button">ADD</a>

                    </div>

                    <div class="card-body">

                        <div class="container bootstrap snippets bootdey">

                            <div class="row" >
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
                                    <div class="panel panel-border panel-primary" >
                                        <div class="panel-heading">
                                        </div>
                                        <div class="panel-body" >
                                            <table id="datatable-fixed-header"
                                                   class="table table-striped table-bordered success">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Display fields</th>
                                                    <th>Options </th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{$category->id}} </td>
                                                        <td>{{$category->name}}</td>
                                                        <td>{{$category->fields}}</td>
                                                        <td>
                                                            <a href="{{route('categories.edit',$category->id)}}"  class="btn btn-outline-primary btn-sm">Edit</a>
                                                            <form method="post" action="{{route('categories.destroy',$category->id)}}" style=" display: inline-block; ">
                                                                @method('delete')
                                                                @csrf
                                                                <button class="btn btn-outline-danger btn-sm">Delete</button>
                                                            </form>
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
