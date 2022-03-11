<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required|unique:personal_access_tokens,name',
        ]);
        if($validator->fails()){
            return response()->json([
                'error'=> true,
                'message' => $validator->errors() ], 401);
        }
        $user = User::where('email', $request->email)
            ->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return Response::json([
                'message' => 'Invalid username and password combination',
            ], 401);
        }
        $token = $user->createToken($request->device_name);
        return Response::json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ]);
    }

    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();

        // Revoke (delete) all user tokens
        $user->tokens()->delete();

        return Response::json('Token has been destroyed successfully',200);
        // Revoke current access token
        //$user->currentAccessToken()->delete();
    }
}
