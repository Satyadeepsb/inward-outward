@extends('layouts.app')

@section('content')
    <div class="{{Auth::user()->hasRole('SUPERUSER') ? 'col-md-12':'col-md-8 col-md-offset-2' }}">
        <div class="panel panel-default">
            <div class="panel-heading">Application Details</div>
            <div class="panel-body">
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
                                    <div class="col-md-7">{{\App\Http\Controllers\ApplicationController::getDeptName($application_remarks[0]->department)}} </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-5"> Officer</label>
                                    <div class="col-md-7">{{\App\Http\Controllers\ApplicationController::getUserName($application_remarks[0]->officer)}} </div>
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
                                    <p style="font-size: 18px;font-weight: bold">{{$application_remark->role}}</p>
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
                        <hr>
                        @if(count($documents) > 0)
                            <p style="font-size: 18px;font-weight: bold">Uploaded Documents</p>
                            @foreach($documents as $document)
                                <a href="{{$document->stored_path}}" target="_blank"> {{$document->name}}</a>
                                <br>
                            @endforeach
                        @endif
                    </div>
                </div>
                @if(($application->status == 'PA_USER UPDATED' && Auth::user()->role == 'CLERK') ||
                $application->status == 'CLERK UPDATED' && Auth::user()->role == 'DEPARTMENT_USER')
                    <div class="row well">

                        <form class="form-horizontal" role="form" method="POST" action="{{route('application.saveRemark')}}"
                              enctype="multipart/form-data" id="uploadForm">
                            {{ csrf_field() }}
                            <input type="text" name="inward_id" id="inward" value="{{$application->inward_no}}" hidden/>
                            <input type="text" name="department2" id="department2"
                                   value="{{$application_remarks[0]->department}}" hidden/>
                            <input type="text" name="officer" id="officer" value="{{$application_remarks[0]->officer}}"
                                   hidden/>
                            <div class="form-group">
                                <label for="actions" class="col-md-4 control-label"> Action</label>

                                <div class="col-md-6">
                                    <select multiple class="form-control" id="actions" name="actions[]" required>
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
                            <div class="form-group">
                                <label for="upload" class="col-md-4 control-label"> Upload Documents</label>
                                <div class="col-md-6">
                                    <input type="file" name="file[]" multiple id="upload">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a class="btn btn-warning" href="{{route('applications.index')}}">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                <div class="col-md-12 text-center">
                    <a href="{{route('applications.index')}}" class="btn btn-warning">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection

