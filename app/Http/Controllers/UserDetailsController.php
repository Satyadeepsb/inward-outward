<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if($id == 0) {
            return view('user_details');
        }else{
            print($id);
            $user = User::find($id);
            return view('user_details')->with('user',$user);
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
            'location' => $data['location'],
            'address' => $data['address'],
            'designation' => $data['designation'],
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
    public function store(Request $request,$id)
    {
        $user = $request->all();
            $newUser = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'mobile' => $user['mobile'],
                'role' => $user['role'],
                'location' => $user['location'],
                'address' => $user['address'],
                'designation' => $user['designation'],
                'password' => bcrypt($user['password'])
            ]);
            $newUser->save();
        Session::flash('success','User created Successfully.');
        return redirect()->action('UsersController@index');

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
        $user->location = $newUser['location'];
        $user->address = $newUser['address'];
        $user->designation = $newUser['designation'];
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
