<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ChangePasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request,$id){
        $user = User::find($id);
        if(Hash::check($request->old_password,$user->password)){
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with(['success' => 'password updated successfully']);
        }else{
            return redirect()->back()->with(['error' => 'something went wrong']);
        }
    }

    public function getChangePasswordForm(){
        return view('auth.change_password');
    }

}
