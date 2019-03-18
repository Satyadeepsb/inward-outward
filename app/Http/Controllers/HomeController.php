<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use DB;
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
        $applications = Application::all();
        foreach ($applications as $application):
            $application['selected'] = true;
            $application->myField = 'true';
        endforeach;
        $actions = DB::table('actions')
            ->where('user_type', $role)
            ->get();
        return view('user_applications')->with('applications', $applications)->with('actions', $actions);
        /*if($role == 'SUPERUSER'){
            return view('home');
        } else {

        }*/

    }
}
