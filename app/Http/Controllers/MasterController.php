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
use Session;
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
                $districts = District::all();
                return view('master_details')
                    ->with('masterName', title_case($type))
                    ->with('master', $master)
                    ->with('districts',$districts);
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

    public function create(Request $request, $type){
        $new = null;
        switch ($type) {
            case 'designation' :
                $new = Designation::create([
                    'name' => $request['name']]);
                break;
            case 'document' :
                $new = Document::create([
                    'name' => $request['name']]);
                break;
            case 'district' :
                $new = District::create([
                    'name' => $request['name']]);
                break;
            case 'taluka' :
                $new = Taluka::create([
                    'name' => $request['name'],
                    'district_id'=> $request['district_id']]);
                break;
            case 'action' :
                $new = Action::create([
                    'action' => $request['action'],
                    'user_type' => $request['user_type']]);
                break;
            case 'department' :
                $new = Department::create([
                    'name' => $request['name']]);
                break;
            case 'location' :
                $new = Location::create([
                    'name' => $request['name']]);
                break;
        }
        if(!is_null($new)){
            $new->save();
            Session::flash('success','Saved Successfully.');
        }
        return redirect()->action('MasterController@index', $type);
    }
    public function update(Request $request,$type, $id)
    {
        $newObject = $request->all();
        $oldObject = null;
        switch ($type) {
            case 'designation' :
                $oldObject = Designation::find($id);
                break;
            case 'document' :
                $oldObject = Document::find($id);
                break;
            case 'district' :
                $oldObject = District::find($id);
                break;
            case 'taluka' :
                $oldObject = Taluka::find($id);
                break;
            case 'action' :
                $oldObject = Action::find($id);
                break;
            case 'department' :
                $oldObject = Department::find($id);
                break;
            case 'location' :
                $oldObject = Location::find($id);
                break;
        }
        if(!is_null($oldObject)){
            if($type != 'action'){
                $oldObject->name = $newObject['name'];
            } else {
                $oldObject->action = $newObject['action'];
                $oldObject->user_type = $newObject['user_type'];
            }
            if($type == 'taluka'){
                $oldObject->district_id = $newObject['district_id'];
            }
            $oldObject->update();
            Session::flash('success','Updated Successfully.');
        }
        return redirect()->action('MasterController@index', $type);

    }


    public static function getDistrictName($id)
    {
        $district= District::where('id', $id)->first();
        if (!is_null($district)) {
            return $district->name;
        }
        return "";
    }

    public function destroy(Request $request)
    {
        $id= $request->master_id;;
        $type = $request->master_type;
        $oldObject = null;
        switch ($type) {
            case 'designation' :
                $oldObject = Designation::findOrFail($id);
                break;
            case 'document' :
                $oldObject = Document::findOrFail($id);
                break;
            case 'district' :
                $oldObject = District::findOrFail($id);
                $talukas = Taluka::where('district_id',$oldObject->id)->get();
                foreach ($talukas as $oldTaluka):
                    $tk = Taluka::where('id', $oldTaluka->id)->first();
                    if(!is_null($tk)){
                        $tk->delete();
                    }
                endforeach;
                break;
            case 'taluka' :
                $oldObject = Taluka::findOrFail($id);
                break;
            case 'action' :
                $oldObject = Action::findOrFail($id);
                break;
            case 'department' :
                $oldObject = Department::findOrFail($id);
                break;
            case 'location' :
                $oldObject = Location::findOrFail($id);
                break;
        }
        if(!is_null($oldObject)){
            $oldObject->delete();
            Session::flash('success','Deleted Successfully.');
        } else {
            Session::flash('error','Data Not Found.');
        }

        return back();
    }
}
