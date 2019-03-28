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
        $smsConfigUrl = Config::where('param_name','url')->first();
        $smsConfigUsername = Config::where('param_name','username')->first();
        $smsConfigPass = Config::where('param_name','pass')->first();
        $smsConfigSenderId = Config::where('param_name','senderid')->first();
        $apiString = "";
        if(!is_null($smsConfigUrl) && !is_null($smsConfigUsername) && !is_null($smsConfigPass) && !is_null($smsConfigSenderId)) {
            $apiString = $smsConfigUrl->param_value;
            $apiString = self::replaceConstant('<api_u_name>', $smsConfigUsername->param_value, $apiString);
            $apiString = self::replaceConstant('<api_password>', $smsConfigPass->param_value, $apiString);
            $apiString = self::replaceConstant('<sender_id>', $smsConfigSenderId->param_value, $apiString);
            $apiString =  self::replaceConstant('<mobile_no>',123456789,$apiString);
            $apiString =  self::replaceConstant('<api_msg>','Test SMS',$apiString);
        }
        return view('settings')
            ->with('settings',$settings)
            ->with('smsConfigUrl', $smsConfigUrl)
            ->with('smsConfigUsername', $smsConfigUsername)
            ->with('smsConfigPass', $smsConfigPass)
            ->with('smsConfigSenderId', $smsConfigSenderId)
            ->with('finalString', $apiString);
    }
    public function update(Request $request)
    {
        Setting::where('name', 'email')->update(['enable' => is_null($request['email']) ? 0 : $request['email']]);
        Setting::where('name', 'sms')->update(['enable' => is_null( $request['sms']) ? 0 : $request['sms']]);
        Session::flash('success', 'Saved Successfully');
    }
    public function url(Request $request)
    {
        Config::where('param_name','url')->update(['param_value' => trim($request['url'])]);
        Config::where('param_name','username')->update(['param_value' => trim($request['username'])]);
        Config::where('param_name','pass')->update(['param_value' => trim($request['pass'])]);
        Config::where('param_name','senderid')->update(['param_value' => trim($request['senderid'])]);
        Session::flash('success', 'Saved Successfully');
        return redirect()->back();
    }
    public static function replaceConstant($constant, $replacedBy, $originalString)
    {
        return str_replace($constant, $replacedBy, $originalString);
    }


}
