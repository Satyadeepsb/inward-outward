<?php

namespace App\Http\Controllers;

use App\Application;
use App\Application_Remark;
use App\Department;
use App\District;
use App\Document;
use App\Setting;
use App\Taluka;
use App\Uploaded_Document;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
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
        $applications = [];
        /* if($role=='PA_USER'){
             $applications = Application::where('status', 'CREATED')->get();
         } elseif ($role=='CLERK'){
             $applications = Application::where('status', 'PA_USER UPDATED')->get();
         } elseif ($role=='DEPARTMENT_USER'){
             $applications = Application::where('status', 'CLERK UPDATED')->get();
         } elseif ($role =='SUPERUSER'){
             $applications = Application::all();
         }*/
        if ($role == 'DEPARTMENT_USER') {
            $completedApplications = DB::table('applications')->where('status','COMPLETED')->where('department', Auth()->user()->department);

            $applications = Application::where('status', '=', 'CLERK UPDATED')
                ->whereNotNull('department')
                ->union($completedApplications)
                ->where('department', Auth()->user()->department)->get();
        }elseif ($role == 'INWARD') {
            $applications = Application::where('user_id', Auth()->user()->id)->get();
        } else {
            $applications = Application::all();
        }

        if ($role == 'SUPERUSER') {
            $role = 'PA_USER';
        }
        $actions = DB::table('actions')
            ->where('user_type', $role)
            ->get();
        $departments = Department::all();
        $users = User::where('role', 'DEPARTMENT_USER')->get();
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
        if (!is_null($app)) {
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
            'districts' => $districts,
            'talukas' => $talukas,
            'documents' => $documents,
            'inward_id' => $lastId,
            'todayDate' => $todayDate];
        return view('create_application')->with('data', $data);
    }

    public function districtChange(Request $request)
    {
        if ($request->ajax()) {

            // $talukas = DB::table('talukas')->where('district_id',$request->district_id)->pluck("name","id")->all();
            // print_r($talukas);
            $talukas = [2 => "Karad", 7 => "Limb"];
            $data = view('create_application', compact('talukas'))->render();
            var_dump($data);
            return response()->json(['options' => $data]);
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
        $output = '<option value="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->name . '">' . $row->name . '</option>';
        }
        echo $output;
    }

    function deptUsers(Request $request)
    {
        // $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $data = DB::table('users')
            ->whereNotNull('department')
            ->where('department', $value)
            ->get();
        $output = '<option value="">Select ' . ucfirst($dependent) . '</option>';
        foreach ($data as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        echo $output;
    }


    function getByDepartment(Request $request)
    {
        // $select = $request->get('select');
        $value = $request->get('value');
        $application_remarks = Application_Remark::where('department', $value)->get();
        $applications2 = DB::table('application__remarks')
            ->leftJoin('applications', 'application__remarks.inward_id', '=', 'applications.inward_no')
            ->where('application__remarks.department', 'Electricity')
            ->get();
        $unique_data = $applications2->unique('inward_id')->values()->all();
        $applications = $unique_data;
        $role = Auth()->user()->role;
        if ($role == 'SUPERUSER') {
            $role = 'PA_USER';
        }
        $actions = DB::table('actions')
            ->where('user_type', $role)
            ->get();
        $departments = Department::all();
        $users = User::where('role', 'DEPARTMENT_USER')->get();
        return view('user_applications')
            ->with('applications', $applications)
            ->with('actions', $actions)
            ->with('departments', $departments)
            ->with('users', $users);
    }


    public function createNew(Request $request)
    {

        $requestObj = $request->all();
        //  dd($requestObj);
        $docString = "";
        if (count($requestObj['documents']) > 0) {
            foreach ($requestObj['documents'] as $doc) {
                $docString = $doc . "," . $docString;
            }
        }
        $requestDate = $requestObj['date'];
        if (empty($requestDate)) {
            $requestDate = date("Y-m-d");
        }
        $district_id = $requestObj['district'];
        $district = District::where('id', $district_id)->get()[0];
        $application = Application::create([
            'name' => $requestObj['name'],
            'subject' => $requestObj['subject'],
            'inward_no' => $requestObj['inward_no'],
            'reference_no' => $requestObj['reference_no'],
            'mobile' => $requestObj['mobile'],
            'address' => $requestObj['address'],
            'district' => $district->name,
            'taluka' => $requestObj['taluka'],
            'status' => 'CREATED',
            'documents' => rtrim($docString, ","),
            'date' => $todayDate = $requestDate,
            'user_id' => Auth()->user()->id,
        ]);
        $application->save();
        Session::flash('success', 'Application created Successfully.');
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
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
        if ($role == 'SUPERUSER') {
            $role = 'PA_USER';
        }
        $actionString = "";
        if (count($request['actions']) > 0) {
            foreach ($request['actions'] as $action) {
                $actionString = $action . "," . $actionString;
            }
        }
        $application_remark = Application_Remark::create([
            'remark' => $request['remark'],
            'inward_id' => $request['inward_id'],
            'officer' => $request['officer'],
            'user_id' => Auth()->user()->id,
            'action' => rtrim($actionString, ","),
            'department' => $request['department'],
            'role' => $role
        ]);
        $application_remark->save();
        Application::where('inward_no', $request['inward_id'])->update(['status' => $role . ' UPDATED']);
        Application::where('inward_no', $request['inward_id'])->update(['department' => $application_remark->department]);
        Session::flash('success', 'Application remark submitted Successfully.');
        return redirect()->back();
    }

    public function remarkMultiple(Request $request)
    {
        //dd($request->all());
        $role = Auth()->user()->role;
        if ($role == 'SUPERUSER') {
            $role = 'PA_USER';
        }
        $appIds = $request['appIds'];
        $str_arr = preg_split("/\,/", $appIds[0]);
        $actionString = "";
        if (count($request['actions']) > 0) {
            foreach ($request['actions'] as $action) {
                $actionString = $action . "," . $actionString;
            }
        }
        foreach ($str_arr as $id) {
            $applications = DB::table('applications')
                ->where('id', $id)
                ->get();
            //dd($applications[0]->status);
            if($applications[0]->status !='CREATED'){
                Session::flash('error', 'Application remark already submitted.');
                break;
            }else {
                $application_remark = Application_Remark::create([
                    'remark' => $request['remark'],
                    'inward_id' => $applications[0]->inward_no,
                    'officer' => $request['officer'],
                    'user_id' => Auth()->user()->id,
                    'action' => rtrim($actionString, ","),
                    'department' => $request['department'],
                    'role' => $role
                ]);
                $application_remark->save();
                Application::where('inward_no', $application_remark['inward_id'])->update(['status' => $role . ' UPDATED']);
            }
            Session::flash('success', 'Application remark submitted Successfully.');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public static function getUserName($id)
    {
        $user_arr = User::where('id', $id)->get();
        if (!is_null($user_arr) && count($user_arr) > 0) {
            $user = $user_arr[0];
            return $user->name;
        }
        return "";
    }

    public static function getDeptName($id)
    {
        $dept_arr = Department::where('id', $id)->get();
        if (!is_null($dept_arr) && count($dept_arr) > 0) {
            $dept = $dept_arr[0];
            return $dept->name;
        }
        return "";
    }

    public function get($id)
    {
        $application_arr = Application::where('inward_no', $id)->get();
        $role = Auth()->user()->role;
        $actions = DB::table('actions')
            ->where('user_type', $role)
            ->get();

        $documents = Uploaded_Document::where('application_id', $id)->get();
        if (!is_null($application_arr) && count($application_arr) > 0) {
            $application = $application_arr[0];
            $application_remarks = Application_Remark::where('inward_id', $id)->get();
            $docArray = explode(',', $application->documents );

            return view('application_details')
                ->with('application', $application)
                ->with('application_remarks', $application_remarks)
                ->with('actions', $actions)
                ->with('documents', $documents)
                ->with('docArray', $docArray);
        } else {
            Session::flash('error', 'No Application Found');
            return redirect()->back();
        }
    }
    public static function removeSpace($docName){
        return str_replace(' ', '_', $docName);
    }
    public static function removeUnderscore($docName){
        return str_replace('_', ' ', $docName);
    }

    public function saveRemark(Request $request,Mailer $mailer)
    {
        try {
            $inward_id = $request['inward_id'];
            $dbApplication = Application::where('inward_no', $inward_id)->first();
            $docArray = explode(',', $dbApplication->documents);
            foreach ($docArray as $doc):
                // $files = array_push($files,$request->file($doc));
                $file = $request->file(self::removeSpace($doc));
                if (!empty($file) || !is_null($file)) {
                    $fileName = $inward_id . '_' . $file->getClientOriginalName();
                    // To Save File In Public/Uploaded Folder
                    $file->move(public_path('/uploaded'), $fileName);
                    // To Save File In Storage/App Folder
                    //Storage::put($fileName, file_get_contents($file));
                    DB::table('uploaded__documents')->insert([
                        [
                            'name' => $fileName,
                            'original_name' => $file->getClientOriginalName(),
                            'document_name' => $doc,
                            'stored_path' => '/uploaded/' . $fileName,
                            'application_id' => $request['inward_id'],
                            'user_id' => Auth()->user()->id
                        ]]);
                }
            endforeach;
            $role = Auth()->user()->role;
            $actionString = "";
            if (count($request['actions']) > 0) {
                foreach ($request['actions'] as $action) {
                    $actionString = $action . "," . $actionString;
                }
            }
            $application_remark = Application_Remark::create([
                'remark' => $request['remark'],
                'comment' => $request['comment'],
                'inward_id' => $request['inward_id'],
                'department' => $request['department2'],
                'user_id' => Auth()->user()->id,
                'role' => $role,
                'officer' => $request['officer'],
                'action' => rtrim($actionString, ",")
            ]);
            $application_remark->save();
            if ($role == 'DEPARTMENT_USER') {
                Application::where('inward_no', $application_remark['inward_id'])->update(['status' => 'COMPLETED']);
            } else {
                Application::where('inward_no', $application_remark['inward_id'])->update(['status' => $role . ' UPDATED']);
            }
            if ($role == 'DEPARTMENT_USER') {
                $applications = Application::where('status', 'CLERK UPDATED')->get();
            } else {
                $applications = Application::all();
            }
            if($role == 'CLERK'){
                $smsSetting = Setting::where('name', 'sms')->first();
                if(!is_null($smsSetting) &&  $smsSetting['enable'] == 1) {
                    $userApplication = Application::where('inward_no', $application_remark['inward_id'])->first();
                    $client = new \GuzzleHttp\Client();
                    $messageText = 'Dear Applicant, Your Application No - ' . $inward_id . ', forwarded to Department - ' . self::getDeptName($application_remark['department']);
                    $smsUrl = 'http://www.smsjust.com/sms/user/urlsms.php?username=techuser&pass=tech@12345&senderid=TNSOFT&dest_mobileno=' . $userApplication->mobile . '&message=' . $messageText . '&response=Y';
                    $smsRequest = $client->get($smsUrl);
                    $smsResponse = $smsRequest->getBody()->getContents();
                }
            }
            if ($role == 'SUPERUSER') {
                $role = 'PA_USER';
            }
            $actions = DB::table('actions')
                ->where('user_type', $role)
                ->get();
            $departments = Department::all();
            $users = User::where('role', 'DEPARTMENT_USER')->get();
            Session::flash('success', 'Saved Successfully');
            return response()->json(['success' => $request->all()]);
        }catch (\Exception $e) {
            Session::flash('error', 'Something went wrong');
            return response()->json(['success' => false]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
