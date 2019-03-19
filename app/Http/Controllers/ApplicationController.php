<?php

namespace App\Http\Controllers;

use App\Application;
use App\Application_Remark;
use App\Department;
use App\District;
use App\Document;
use App\Taluka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Storage;
use DB;
use App\User;


class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth()->user()->role;
        $applications =[];
        if($role=='PA_USER'){
            $applications = Application::where('status', 'CREATED')->get();
        } elseif ($role=='CLERK'){
            $applications = Application::where('status', 'PA_USER UPDATED')->get();
        } elseif ($role=='DEPARTMENT_USER'){
            $applications = Application::where('status', 'CLERK UPDATED')->get();
        } elseif ($role =='SUPERUSER'){
            $applications = Application::all();
        }
        if($role =='SUPERUSER'){
            $role='PA_USER';
        }
        foreach ($applications as $application):
            $application['selected'] = true;
            $application->myField = 'true';
        endforeach;
        $actions = DB::table('actions')
            ->where('user_type', $role)
            ->get();
        $departments = Department::all();
        $users= User::all();
        return view('user_applications')
            ->with('applications', $applications)
            ->with('actions', $actions)
            ->with('departments', $departments)
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $app = Application::orderBy('id', 'desc')->first();
        $lastId = 0;
        if(!is_null($app)){
            $lastId = $app->id;
        }
        $lastId = $lastId + 1001;
        $todayDate = date("Y-m-d");
        $districts = District::all();
        $documents = Document::all();
        $talukas = Taluka::all();
        //$talukas1 = DB::table('talukas')->where('district_id',2)->pluck("name","id")->all();
        //dd($talukas1);
        $data = [
            'districts'=>$districts,
            'talukas'=>$talukas,
            'documents'=>$documents,
            'inward_id'=>$lastId,
            'todayDate'=>$todayDate];
        return view('create_application')->with('data', $data);
    }

    public  function districtChange(Request $request){
        if($request->ajax()){

            // $talukas = DB::table('talukas')->where('district_id',$request->district_id)->pluck("name","id")->all();
            // print_r($talukas);
            $talukas = [2 => "Karad", 7 => "Limb"];
            $data = view('create_application',compact('talukas'))->render();
            var_dump($data);
            return response()->json(['options'=>$data]);
        }
    }
    function fetch(Request $request)
    {
        // $select = $request->get('select');
        $value = $request->get('value');
         $dependent = $request->get('dependent');
        $data = DB::table('talukas')
            ->where('district_id', $value)
            ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        echo $output;
    }

    public function createNew(Request $request)
    {
        $requestObj = $request->all();
        /*print_r($requestObj);
        $files = $request->file('file');
        print_r($files);
        if(!empty($files)) {
            foreach ($files as $file) :
                $fileName = time() . $file->getClientOriginalName();
                print_r('File Name ');
                print_r($fileName);
                // To Save File In Public/Uploaded Folder
               $file->move(public_path('/uploaded'), $fileName);
                // To Save File In Storage/App Folder
               // Storage::put($fileName, file_get_contents($file));
            endforeach;
        }*/
        $docString = "";
        if(count($requestObj['documents']) > 0){
            foreach ($requestObj['documents'] as $doc) {
                $docString =  $doc."," .  $docString;
            }
        }
        $requestDate = $requestObj['date'];
        if(empty($requestDate)){
            $requestDate = date("Y-m-d");
        }
        $application = Application::create([
            'name' => $requestObj['name'],
            'inward_no' => $requestObj['inward_no'],
            'reference_no' => $requestObj['reference_no'],
            'mobile' => $requestObj['mobile'],
            'address' => $requestObj['address'],
            'district' => $requestObj['district'],
            'taluka' => $requestObj['taluka'],
            'status' => 'CREATED',
            'documents' => rtrim($docString,",") ,
            'date' =>$todayDate = $requestDate,
            'user_id' => Auth()->user()->id,
        ]);
        $application->save();
        Session::flash('success','Application created Successfully.');
        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }
    public function remark(Request $request)
    {
        //dd($request->all());
        $role = Auth()->user()->role;
        if($role == 'SUPERUSER'){
            $role = 'PA_USER';
        }
        $actionString = "";
        if(count($request['actions']) > 0){
            foreach ($request['actions'] as $action) {
                $actionString =  $action."," .  $actionString;
            }
        }
        $application_remark = Application_Remark::create([
            'remark' => $request['remark'],
            'inward_id' => $request['inward_id'],
            'officer' => $request['officer'],
            'user_id' =>  Auth()->user()->id,
            'action' => rtrim($actionString,","),
            'department' => $request['department'],
            'role' => $role
        ]);
        $application_remark->save();
        Application::where('inward_no', $request['inward_id'])->update(['status' => $role.' UPDATED']);
        Session::flash('success','Application remark submitted Successfully.');
        return redirect()->back();
    }
    public function remarkMultiple(Request $request)
    {
        //dd($request->all());
        $role = Auth()->user()->role;
        if($role == 'SUPERUSER'){
            $role = 'PA_USER';
        }
        $appIds = $request['appIds'];
        $str_arr = preg_split ("/\,/", $appIds[0]);
        $actionString = "";
        if(count($request['actions']) > 0){
            foreach ($request['actions'] as $action) {
                $actionString =  $action."," .  $actionString;
            }
        }
        foreach ($str_arr as $id) {
            $applications = DB::table('applications')
                ->where('id', $id)
                ->get();
            $application_remark = Application_Remark::create([
                'remark' => $request['remark'],
                'inward_id' => $applications[0]->inward_no,
                'officer' => $request['officer'],
                'user_id' =>  Auth()->user()->id,
                'action' => rtrim($actionString,","),
                'department' => $request['department'],
                'role' => $role
            ]);
            $application_remark->save();
            Application::where('inward_no', $application_remark['inward_id'])->update(['status' => $role.' UPDATED']);
        }
        Session::flash('success','Application remark submitted Successfully.');
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        print_r($request->all());
        return view('auth.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public static function getUserName($id) {
        $user_arr = User::where('id', $id)->get();
        if(!is_null($user_arr) && count($user_arr)> 0) {
            $user = $user_arr[0];
            return $user->name;
        }
        return "";
    }
    public function get($id)
    {
        $application_arr = Application::where('inward_no', $id)->get();
        if(!is_null($application_arr) && count($application_arr)> 0) {
            $application = $application_arr[0];
            $application_remarks = Application_Remark::where('inward_id', $id)->get();
            return view('application_details')
                ->with('application',$application)
                ->with('application_remarks',$application_remarks);
        } else{
            Session::flash('error','No Application Found');
            return redirect()->back();
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
