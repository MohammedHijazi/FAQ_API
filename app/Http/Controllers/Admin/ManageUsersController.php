<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;

class ManageUsersController extends Controller
{

    public function index()
    {
        $users=User::all();
        if(Auth::user()->email=="allbdrii99@gmail.com") {
            return view('admin.usersManagement.index', compact('users'));
        }else{
            return view(RouteServiceProvider::HOME);
        }
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

    }


    public function update(Request $request, $id)
    {
        $user=User::where('id',$id)->first();
        if($request->plus){
            $re=Carbon::parse($user->valid_til)->addDays(30);
            $user->valid_til=$re;
        }else{
            $re=Carbon::now();
            $user->valid_til=$re;
        }

        $user->save();
        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}
