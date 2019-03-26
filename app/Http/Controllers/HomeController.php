<?php

namespace App\Http\Controllers;

use App\Application;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Department;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Auth()->user()->role;
        $applications =[];
       /* if($role=='PA_USER'){
            $applications = Application::where('status', 'CREATED')->get();
        } elseif ($role=='CLERK'){
            $applications = Application::where('status', 'PA_USER UPDATED')->get();
        } elseif ($role=='DEPARTMENT_USER'){
            $applications = Application::where('status', 'CLERK UPDATED')->get();
        } elseif ($role =='SUPERUSER'){
            $applications = Application::all();
        }*/
//dd(Auth()->user()->department);
        if ($role=='DEPARTMENT_USER'){
            $completedApplications = DB::table('applications')->where('status','COMPLETED')->where('department', Auth()->user()->department);

            $applications = Application::where('status', '=', 'CLERK UPDATED')
                ->whereNotNull('department')
                ->union($completedApplications)
                ->where('department', Auth()->user()->department)->get();
        } elseif ($role == 'INWARD') {
            $applications = Application::where('user_id', Auth()->user()->id)->get();
        } else {
            $applications = Application::all();
        }
        if($role =='SUPERUSER'){
            $role='PA_USER';
        }

        $actions = DB::table('actions')
            ->where('user_type', $role)
            ->get();
        $departments = Department::all();
        $users= User::where('role','DEPARTMENT_USER')->get();
        return view('user_applications')
            ->with('applications', $applications)
            ->with('actions', $actions)
            ->with('departments', $departments)
            ->with('users', $users);
        /*if($role == 'SUPERUSER'){
            return view('home');
        } else {

        }*/

    }
}
