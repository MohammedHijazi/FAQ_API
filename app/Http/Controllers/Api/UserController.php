<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function index(){
        $user_id=auth()->user()->id;
        $user=User::where('id',$user_id)->first();
        $time_left=Carbon::now()->diffInDays(Carbon::parse($user->valid_til));
        return Response::json(strval($time_left)." days",200);
    }
}
