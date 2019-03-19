<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all();
        //dd($settings);
       return view('settings')->with('settings',$settings);
    }
    public function update(Request $request)
    {
        print_r('aaaaaaaaaaaa');
        // return view('settings');
    }
}
