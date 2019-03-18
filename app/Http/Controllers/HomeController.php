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
        /*if($role == 'SUPERUSER'){
            return view('home');
        } else {

        }*/

    }
}
