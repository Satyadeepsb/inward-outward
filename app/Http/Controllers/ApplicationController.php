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
        if($role =='SUPERUSER'){
            $role='PA_USER';
        }
        $applications = Application::all();
        foreach ($applications as $application):
            $application['selected'] = true;
            $application->myField = 'true';
        endforeach;
        $actions = DB::table('actions')
            ->where('user_type', $role)
            ->get();
        $departments = Department::all();
        $users= User::all();
        return view('user_applications')->with('applications', $applications)->with('actions', $actions)->with('departments', $departments)->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastId = Application::orderBy('id', 'desc')->first()->id;
        $lastId = $lastId + 1001;
        $todayDate = date("Y-m-d");
        $districts = District::all();
        $documents = Document::all();
        $talukas = Taluka::all();
        $data = ['districts'=>$districts,
            'talukas'=>$talukas,
            'documents'=>$documents,
            'inward_id'=>$lastId,
            'todayDate'=>$todayDate];
        return view('create_application')->with('data', $data);
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

        $application_remark = Application_Remark::create([
            'remark' => $request['remark'],
            'inward_id' => $request['inward_id'],
            'user_id' => $request['user_id'],
            'action' => $request['action'],
            'department' => $request['department'],
            'role' => $role
        ]);
        $application_remark->save();
        Application::where('inward_no', $request['inward_id'])->update(['status' => $role.' UPDATED']);
        Session::flash('success','Application remark submitted Successfully.');
        return redirect()->action('ApplicationController@index');
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
