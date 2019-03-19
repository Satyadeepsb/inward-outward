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
        /*if($role == 'SUPERUSER'){
            return view('home');
        } else {

        }*/

    }
}
