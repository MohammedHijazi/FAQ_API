@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="width: 900px">
                    <div class="card-header" style=" display: flex; justify-content: space-between; align-content: center; align-items: center;">Manage Categories
                        <a class="btn btn-primary" href="{{route('register')}}" role="button">ADD</a>
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
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th style="width: 120px">UserSince </th>
                                                    <th style="width: 220px">Active til</th>
                                                    <th style="width: 150px">expire in</th>
                                                    <th>Options</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach ($users as $user)

                                                    <tr>
                                                        <td>{{$user->id}} </td>
                                                        <td>{{$user->name}}</td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->created_at->diffForHumans()}}</td>
                                                        <td>{{\Carbon\Carbon::parse($user->valid_til)->toDateString()}}</td>
                                                        <td>{{\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($user->valid_til))}} days</td>
                                                        <td>
                                                            <form method="post" action="{{route('users.update',$user->id)}}">
                                                                @method('put')
                                                                @csrf
                                                                <input type="hidden" name="plus" value="{{true}}">
                                                                <button type="submit" class="btn btn-outline-danger btn-sm">Add 30 days</button>
                                                            </form>
                                                            <form method="post" action="{{route('users.update',$user->id)}}">
                                                                @method('put')
                                                                @csrf
                                                                <input type="hidden" name="minus" value={{true}}>
                                                                <button type="submit" class="btn btn-outline-danger btn-sm">Deactivate</button>
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
