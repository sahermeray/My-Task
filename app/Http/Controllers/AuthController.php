<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        if($request->has('email')){
        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password'))
        ]);}
        else{
            $user = User::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'phone' => $request->get('phone'),
                'password' => bcrypt($request->get('password'))
            ]);
        }
        $token = $user->createToken('user_token')->plainTextToken;
        if($user){
            return response([
                'user' => $user,
                'token' => $token
            ]);
        }else{
            return response([
                'message' => 'something went wrong',
            ]);
        }
    }

    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return response([
           'message'=>'logged out successfully'
        ]);
    }

    public function login(LoginRequest $request){
        if(is_numeric($request->input('login'))) {
            $user = User::where('phone', $request->get('login'))->first();
        }else{
            $user = User::where('email', $request->get('login'))->first();
        }

        if (!$user || !Hash::check($request->get('password'),$user->password)){
            return response([
                'message'=>'worong credentials'
            ],401);
        }
            $token = $user->createToken('user_token')->plainTextToken;
            return response([
                'user' => $user,
                'token' => $token
            ]);
    }

    public function changePassword(ChangePasswordRequest $request){
        $user = $request->user();
      if(Hash::check($request->old_password,$user->password)){
          $user->update([
             'password' => Hash::make($request->password)
          ]);
          return response([
              'message' => 'password updated successfully'
          ],200);
      }else{
          return response([
              'message'=>'old password does no matched'
          ],401);
      }
    }
}
