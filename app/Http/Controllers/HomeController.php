<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;

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
        return view('user_applications')->with('applications',$applications);
        /*if($role == 'SUPERUSER'){
            return view('home');
        } else {

        }*/

    }
}
