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
        switch ($type) {
            case 'designation' :
                $masters = Designation::all();
                return view('masters')
                    ->with('masterName', title_case($type))
                    ->with('masters', $masters);
                break;
            case 'document' :
                $masters = Document::all();
                return view('masters')
                    ->with('masterName', title_case($type))
                    ->with('masters', $masters);
                break;
            case 'district' :
                $masters = District::all();
                return view('masters')
                    ->with('masterName', title_case($type))
                    ->with('masters', $masters);
                break;
            case 'taluka' :
                $masters = Taluka::all();
                return view('masters')
                    ->with('masterName', title_case($type))
                    ->with('masters', $masters);
                break;
            case 'action' :
                $masters = Action::all();
                return view('masters')
                    ->with('masterName', title_case($type))
                    ->with('masters', $masters);
                break;
            case 'department' :
                $masters = Department::all();
                return view('masters')
                    ->with('masterName', title_case($type))
                    ->with('masters', $masters);
                break;
            case 'location' :
                $masters = Location::all();
                return view('masters')
                    ->with('masterName', title_case($type))
                    ->with('masters', $masters);
                break;
        }
    }

    public function getMasterDetails($type,$id) {

        if($id == 0) {
            return view('master_details')
                ->with('masterName', title_case($type));
        } else {
            switch ($type) {
                case 'designation' :
                    $master = Designation::where('id',$id)->first();
                    return view('master_details')
                        ->with('masterName', title_case($type))
                        ->with('master', $master);
                    break;
                case 'document' :
                    $master = Document::where('id',$id)->first();
                    return view('master_details')
                        ->with('masterName', title_case($type))
                        ->with('master', $master);
                    break;
                case 'district' :
                    $master = District::where('id',$id)->first();
                    return view('master_details')
                        ->with('masterName', title_case($type))
                        ->with('master', $master);
                    break;
                case 'taluka' :
                    $master = Taluka::where('id',$id)->first();
                    return view('master_details')
                        ->with('masterName', title_case($type))
                        ->with('master', $master);
                    break;
                case 'action' :
                    $master = Action::where('id',$id)->first();
                    return view('master_details')
                        ->with('masterName', title_case($type))
                        ->with('master', $master);
                    break;
                case 'department' :
                    $master = Department::where('id',$id)->first();
                    return view('master_details')
                        ->with('masterName', title_case($type))
                        ->with('master', $master);
                    break;
                case 'location' :
                    $master = Location::where('id',$id)->first();
                    return view('master_details')
                        ->with('masterName', title_case($type))
                        ->with('master', $master);
                    break;
            }
        }

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
