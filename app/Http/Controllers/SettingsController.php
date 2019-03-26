<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Session;
class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
       return view('settings')->with('settings',$settings);
    }
    public function update(Request $request)
    {
        Setting::where('name', 'email')->update(['enable' => is_null($request['email']) ? 0 : $request['email']]);
        Setting::where('name', 'sms')->update(['enable' => is_null( $request['sms']) ? 0 : $request['sms']]);
        Session::flash('success', 'Saved Successfully');
    }
}
