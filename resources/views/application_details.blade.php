@extends('layouts.app')

@section('content')
    <div class="{{Auth::user()->hasRole('SUPERUSER') ? 'col-md-12':'col-md-8 col-md-offset-2' }}">
        <div class="panel panel-default">
            <div class="panel-heading">Application Details</div>
            <div class="panel-body">
                <div class="panel panel-default fadeInDown">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-2" style="font-weight: bold"><b>Application Name</b></label>
                                <div class="col-md-10" style="font-weight: bold">{{$application->name}} </div>
                            </div>
                            <div class="col-md-12">
                                <label class="col-md-2" style="font-weight: bold"><b>Subject</b></label>
                                <div class="col-md-10" style="font-weight: bold">{{$application->subject}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5"><b>Inward Number</b></label>
                                <div class="col-md-7">{{$application->inward_no}} </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"><b> Reference Number</b></label>
                                <div class="col-md-7">{{$application->reference_no}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5"> <b>Date</b></label>
                                <div class="col-md-7">{{$application->date}}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"><b>Mobile</b></label>
                                <div class="col-md-7">{{$application->mobile}} </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5"><b>Status</b></label>
                                <div class="col-md-7">{{\App\Http\Controllers\ApplicationController::removeUnderscore($application->status)}} </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"> <b>Address</b></label>
                                <div class="col-md-7">{{$application->address}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-md-5"><b>District</b></label>
                                <div class="col-md-7">{{$application->district}} </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-5"> <b>Taluka</b></label>
                                <div class="col-md-7">{{$application->taluka}}</div>
                            </div>
                        </div>
                        @if(count($application_remarks) > 0)
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-md-5"><b>Department</b></label>
                                    <div class="col-md-7">{{\App\Http\Controllers\ApplicationController::getDeptName($application_remarks[0]->department)}} </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-5"> <b>Officer</b></label>
                                    <div class="col-md-7">{{\App\Http\Controllers\ApplicationController::getUserName($application_remarks[0]->officer)}} </div>
                                </div>
                            </div>
                        @endif
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="col-md-2"><b>Documents</b></label>
                                <div class="col-md-10">
                                    <ol>
                                        @foreach($docArray as $document)
                                            <li>{{$document}}</li>
                                            @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>

                        @foreach ($application_remarks as $key => $application_remark)
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 18px;font-weight: bold">{{\App\Http\Controllers\ApplicationController::removeUnderscore($application_remark->role)}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-2"><b>Action</b></label>
                                    <div class="col-md-10">{{$application_remark->action}} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-2"><b>Remark</b></label>
                                    <div class="col-md-10">{{$application_remark->remark}} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-md-2"><b>Remark By</b></label>
                                    <div class="col-md-10">{{\App\Http\Controllers\ApplicationController::getUserName($application_remark->user_id)}} </div>
                                </div>
                            </div>
                            @if(count($application_remarks) > 0)
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="col-md-2"><b>Department</b></label>
                                        <div class="col-md-10">{{\App\Http\Controllers\ApplicationController::getDeptName($application_remarks[0]->department)}}  </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="col-md-2"><b>Officer</b></label>
                                        <div class="col-md-10">{{\App\Http\Controllers\ApplicationController::getUserName($application_remarks[0]->officer)}}  </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <hr>
                        @if(count($application_remarks) < 1)
                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: 18px;font-weight: bold">PA User</p>
                                <p style="font-size: 14px;font-weight: bold">Remark : Pending</p>
                            </div>
                        </div>
                        @endif
                        @if(count($application_remarks) < 2)
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 18px;font-weight: bold">Clerk</p>
                                    <p style="font-size: 14px;font-weight: bold">Remark : Pending</p>
                                </div>
                            </div>
                        @endif
                        @if(count($application_remarks) < 3)
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="font-size: 18px;font-weight: bold">Department User</p>
                                    <p style="font-size: 14px;font-weight: bold">Remark : Pending</p>
                                </div>
                            </div>
                        @endif
                        @if(count($documents) > 0)
                            <p style="font-size: 18px;font-weight: bold">Uploaded Documents</p>
                            @foreach($documents as $document)
                                <b>{{$document->document_name}} : </b>
                                <a href="{{$document->stored_path}}" target="_blank">{{$document->original_name}}</a>
                                <br>
                            @endforeach
                        @endif
                    </div>
                </div>
                @if(($application->status == 'PA_USER UPDATED' && Auth::user()->role == 'CLERK') ||
                $application->status == 'CLERK UPDATED' && Auth::user()->role == 'DEPARTMENT_USER')
                    <div class="row well">

                        <form class="form-horizontal" role="form" method="POST"
                              action="{{route('application.saveRemark')}}"
                              enctype="multipart/form-data" id="uploadForm">
                            {{ csrf_field() }}
                            <input type="text" name="inward_id" id="inward" value="{{$application->inward_no}}" hidden/>
                            <input type="text" name="department2" id="department2"
                                   value="{{$application_remarks[0]->department}}" hidden/>
                            <input type="text" name="officer" id="officer" value="{{$application_remarks[0]->officer}}"
                                   hidden/>
                            <div class="form-group">
                                <label for="user-actions" class="col-md-4 control-label"> Action</label>
                                <div class="col-md-6">
                                    <select multiple class="form-control" id="user-actions" name="actions[]" required>
                                        @foreach($actions as $action)
                                            <option value="{{$action->action}}">{{$action->action}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="actions" class="col-md-4 control-label">Remark</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="remark" name="remark" required/>
                                </div>
                            </div>
                            @if(Auth::user()->hasRole('DEPARTMENT_USER'))
                                <div class="form-group">
                                    <label for="comment" class="col-md-4 control-label"> Comment</label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" name="comment" id="comment"></textarea>
                                    </div>
                                </div>
                            @endif
                            @if(Auth::user()->role == 'CLERK')
                                <div>
                                    @foreach($docArray as $document)
                                        <div class="form-group">
                                            <label for="{{\App\Http\Controllers\ApplicationController::removeSpace($document)}}"
                                                   class="col-md-4 control-label"> Upload {{$document}}</label>
                                            <div class="col-md-6">
                                                <input type="file"
                                                       name="{{\App\Http\Controllers\ApplicationController::removeSpace($document)}}"
                                                       id="{{\App\Http\Controllers\ApplicationController::removeSpace($document)}}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if(Auth::user()->role == 'DEPARTMENT_USER')
                                <div class="form-group">
                                    <label for="upload" class="col-md-4 control-label"> Upload Documents</label>
                                    <div class="col-md-6">
                                        <input type="file" name="file[]" multiple id="upload">
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a class="btn btn-warning" href="{{route('applications.index')}}">Cancel <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                    <button type="submit" class="btn btn-primary">Save  <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                <div class="col-md-12 text-center">
                    <a href="{{route('applications.index')}}" class="btn btn-warning">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

