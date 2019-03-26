<?php

namespace App\Http\Controllers;

use App\Department;
use App\Designation;
use App\Location;
use App\Setting;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Mail\Mailer;
use Session;
class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $departments = Department::all();
        $locations = Location::all();
        $designations = Designation::all();
        if($id == 0) {
            return view('user_details')
                ->with('departments',$departments)
                ->with('locations',$locations)
                ->with('designations',$designations);
        }else{
            $user = User::find($id);
            return view('user_details')
                ->with('user',$user)
                ->with('departments',$departments)
                ->with('locations',$locations)
                ->with('designations',$designations);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'role' => $data['role'],
            'department' => $data['department'],
            'location' => $data['location'],
            'address' => $data['address'],
            'designation' => $data['designation'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);

        // return redirect()->route('users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Mailer $mailer)
    {
        $user = $request->all();
        $oldUser = User::where('email', trim($user['email']))->first();
        if(is_null($oldUser) || empty($oldUser)) {
            $userMobile = $user['mobile'];
            $userEmail = $user['email'];
            $userPass = $user['password'];
            $newUser = User::create([
                'name' => $user['name'],
                'email' => trim($user['email']),
                'mobile' => $user['mobile'],
                'role' => $user['role'],
                'department' => $user['department'],
                'location' => $user['location'],
                'address' => $user['address'],
                'designation' => $user['designation'],
                'username' =>$user['username'],
                'password' => bcrypt($user['password'])
            ]);
            $newUser->save();
            $smsSetting = Setting::where('name', 'sms')->first();
            if(!is_null($smsSetting) &&  $smsSetting['enable'] == 1){
                $client = new \GuzzleHttp\Client();
                $messageText = 'Hello ' .  $newUser->name . ' Your credential for Inward-Outward Management are Username ' . $userEmail . ' Password ' .$userPass;
                $smsUrl = 'http://www.smsjust.com/sms/user/urlsms.php?username=techuser&pass=tech@12345&senderid=TNSOFT&dest_mobileno=' . $userMobile .'&message='. $messageText.'&response=Y';
                $smsRequest = $client->get($smsUrl);
                $smsResponse = $smsRequest->getBody()->getContents();
            }
            $mailSetting = Setting::where('name', 'email')->first();
            if(!is_null($mailSetting) &&  $mailSetting['enable'] == 1){
                $mailer->
                to($userEmail)->
                send(new \App\Mail\RegisterMail($userEmail,$userPass,'http://localhost:8000/login',$newUser->name));
            }
            Session::flash('success','User created Successfully.');
            return redirect()->action('UsersController@index');
        } else{
            Session::flash('error','Email already Exist.');
            return redirect()->action('UserDetailsController@index', 0);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $newUser = $request->all();
        $user = User::find($id);
        $user->name = $newUser['name'];
        $user->email = $newUser['email'];
        $user->mobile = $newUser['mobile'];
        $user->role = $newUser['role'];
        $user->department = $newUser['department'];
        $user->location = $newUser['location'];
        $user->address = $newUser['address'];
        $user->designation = $newUser['designation'];
        $user->username = $newUser['username'];
        $user->update();
        Session::flash('success','User Updated Successfully.');
        return redirect()->action('UsersController@index');

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
