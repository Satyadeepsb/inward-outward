<?php

namespace App\Http\Controllers;

use App\Config;
use App\Setting;
use Illuminate\Http\Request;
use Session;
class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        $configs = Config::all();
       return view('settings')->with('settings',$settings)->with('configs', $configs);
    }
    public function update(Request $request)
    {
        Setting::where('name', 'email')->update(['enable' => is_null($request['email']) ? 0 : $request['email']]);
        Setting::where('name', 'sms')->update(['enable' => is_null( $request['sms']) ? 0 : $request['sms']]);
        Session::flash('success', 'Saved Successfully');
    }
    public function url(Request $request)
    {
        Config::where('id', 1)->update(['url' => $request['url']]);
        Session::flash('success', 'Saved Successfully');
        return redirect()->back();
    }
}
