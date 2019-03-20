@extends('layouts.app')

@section('content')
    <div class="{{Auth::user()->hasRole('SUPERUSER') ? 'col-md-12':'col-md-8 col-md-offset-2' }}">
        <div class="panel panel-default">
            <div class="panel-heading">Application Details</div>
            <div class="panel-body">
                {{--<form class="form-horizontal"
                      role="form" method="POST"
                      action="{{route('application.createNew')}}"
                      id="uploadForm"
                      enctype="multipart/form-data"
                >
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="upload" class="col-md-4 control-label"> Inward Number</label>
                        <div class="col-md-6">
                            <input type="file" name="file[]" multiple id="upload">
                            <input type="submit" class="btn btn-info">
                        </div>
                    </div>
                </form>--}}



                <div class="panel panel-default fadeInDown">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5">Inward Number</label>
                                <div class="col-md-7">{{$application->inward_no}} </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"> Reference Number</label>
                                <div class="col-md-7">{{$application->reference_no}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5">Application Name</label>
                                <div class="col-md-7">{{$application->name}} </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"> Date</label>
                                <div class="col-md-7">{{$application->date}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5">Mobile</label>
                                <div class="col-md-7">{{$application->mobile}} </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"> Address</label>
                                <div class="col-md-7">{{$application->address}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5">District</label>
                                <div class="col-md-7">{{$application->district}} </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"> Taluka</label>
                                <div class="col-md-7">{{$application->taluka}}</div>
                            </div>
                        </div>
                        @if(count($application_remarks) > 0)
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5">Department</label>
                                <div class="col-md-7">{{$application_remarks[0]->department}} </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"> Officer</label>
                                <div class="col-md-7">{{\App\Http\Controllers\ApplicationController::getUserName($application_remarks[0]->user_id)}} </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5">Status</label>
                                <div class="col-md-7">{{$application->status}} </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-2">Documents</label>
                                <div class="col-md-10">{{$application->documents}}</div>
                            </div>
                        </div>
                        @foreach ($application_remarks as $key => $application_remark)
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>{{$application_remark->role}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-2">Action</label>
                                    <div class="col-md-10">{{$application_remark->action}} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-2">Remark</label>
                                    <div class="col-md-10">{{$application_remark->remark}} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-2">Remark By</label>
                                    <div class="col-md-10">{{\App\Http\Controllers\ApplicationController::getUserName($application_remark->user_id)}} </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="row well">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('application.createNew')}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label"> Inward Number</label>
                            <div class="col-md-6">
                                <label class="control-label">{{$application->inward_no}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reference_no" class="col-md-4 control-label"> Reference Number</label>
                            <div class="col-md-6">
                                <label class="control-label">{{$application->reference_no}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Application Name</label>

                            <div class="col-md-6">
                                <label class="control-label">{{$application->name}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a class="btn btn-warning" href="{{route('applications.index')}}">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

