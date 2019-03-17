<?php

namespace App\Http\Controllers;

use App\Application;
use App\Document;
use Illuminate\Http\Request;
use Session;
use Storage;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::all();
        return view('user_applications')->with('applications',$applications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documents = Document::all();
        return view('create_application')->with('documents', $documents);
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
           $application = Application::create([
               'name' => $requestObj['name'],
               'inward_no' => $requestObj['inward_no'],
               'mobile' => $requestObj['mobile'],
               'address' => $requestObj['address'],
               'district' => $requestObj['district'],
               'taluka' => $requestObj['taluka'],
               'status' => 'CREATED',
               'documents' => rtrim($docString,",") ,
               'date' =>$todayDate = date("Y-m-d"),
               'user_id' => 2,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
