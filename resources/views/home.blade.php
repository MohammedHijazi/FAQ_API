@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <div class="col-md-4 ">
                                <a href="{{route('questions.index')}}" class="btn btn-lg btn-block btn-primary">
                                    Questions
                                </a>
                            </div>
                            <div class="col-md-4 ">
                                <a href="{{route('categories.index')}}" class="btn btn-lg btn-block btn-primary">
                                    Categories
                                    <br>
                                </a>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->email=="allbdrii99@gmail.com")
                            <div class="col-md-4 ">
                                <a href="{{route('users.index')}}" class="btn btn-lg btn-block btn-primary">
                                    Users
                                    <br>
                                </a>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
