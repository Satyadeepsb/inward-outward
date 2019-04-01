<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Session;
class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('change_password');
    }
    public function change(Request $request){
        //dd($request->all());
        if($request->newPassword == $request->confirmPassword) {
            $user = User::where('id', Auth()->user()->id)->first();
            // dd($user->password);
            if (!is_null($user) && password_verify($request->oldPassword, $user->password)) {
                User::where('id', Auth()->user()->id)->update(['password' =>  bcrypt($request->newPassword)]);
                Session::flash('success','Password Changed Successfully.');
                return redirect()->back();
            }else{
                Session::flash('error','Old Password does not match.');
                return view('change_password');
            }
        }else{
            Session::flash('error','New Password and Confirm password does not match.');
            return view('change_password');
        }
    }
}
