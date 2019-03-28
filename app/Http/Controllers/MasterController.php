<?php

namespace App\Http\Controllers;

use App\Action;
use App\Department;
use App\Designation;
use App\District;
use App\Document;
use App\Location;
use App\Taluka;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    public function index($type)
    {
        $masters = null;
        switch ($type) {
            case 'designation' :
                $masters = Designation::all();
                break;
            case 'document' :
                $masters = Document::all();
                break;
            case 'district' :
                $masters = District::all();
                break;
            case 'taluka' :
                $masters = Taluka::all();
                break;
            case 'action' :
                $masters = Action::all();
                break;
            case 'department' :
                $masters = Department::all();
                break;
            case 'location' :
                $masters = Location::all();
                break;
        }
        return view('masters')
            ->with('masterName', title_case($type))
            ->with('masters', $masters);
    }

    public function getMasterDetails($type,$id) {
        $master = null;
        switch ($type) {
            case 'designation' :
                $master = Designation::where('id',$id)->first();
                break;
            case 'document' :
                $master = Document::where('id',$id)->first();
                break;
            case 'district' :
                $master = District::where('id',$id)->first();
                break;
            case 'taluka' :
                $master = Taluka::where('id',$id)->first();
                break;
            case 'action' :
                $master = Action::where('id',$id)->first();
                break;
            case 'department' :
                $master = Department::where('id',$id)->first();
                break;
            case 'location' :
                $master = Location::where('id',$id)->first();
                break;
        }
        return view('master_details')
            ->with('masterName', title_case($type))
            ->with('master', $master);

    }

    public static function getDistrictName($id)
    {
        $district= District::where('id', $id)->first();
        if (!is_null($district)) {
            return $district->name;
        }
        return "";
    }

    public function delete(Request $request)
    {
        dd($request->all());
        /*$userId= $request->user_id;
        $user = User::findOrFail($userId);
        $user->delete();
        Session::flash('success','User Deleted Successfully.');
        return back();*/
    }
}
