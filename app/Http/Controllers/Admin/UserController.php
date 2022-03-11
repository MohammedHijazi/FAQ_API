<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function edit(){
        $user = Auth::user();

        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request){
        $user  =  User::where( 'id', Auth::id())->first();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id.',id'

        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if(!empty($request->input('password'))){
            $request->validate([
                'old-password' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->getAuthPassword())) {
                            $fail('Old Password didn\'t match');
                        }
                    },
                ],
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
            ]);

            $user->password = Hash::make($request->password);

        }
        $user->save();
        return redirect()->back()->with('success', 'Password has been updated successfully');
    }
}
