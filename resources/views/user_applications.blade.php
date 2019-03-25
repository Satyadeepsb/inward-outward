@extends('layouts.app')

@section('content')
    <div class="{{Auth::user()->hasRole('SUPERUSER') ? 'col-md-12':'col-md-10 col-md-offset-1' }}"
         style="margin-top: 0px;padding-top: 0px">
        <div class="col-md-12 tile-highlight text-center" style="margin-bottom: 5px">
            <div class="{{((Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER') || Auth::user()->hasRole('USER')))? 'col-md-11': 'col-md-12'}}">
                <p style="color: white;font-size: 20px">Applications</p>
            </div>
            @if(Auth::user()->hasRole('SUPERUSER') || Auth::user()->hasRole('USER') || Auth::user()->hasRole('PA_USER'))
            <div class="col-md-1">
                @if(Auth::user()->hasRole('SUPERUSER') || Auth::user()->hasRole('USER'))
                    <a href="{{route('application.create')}}"
                       class="btn btn-default btn-sm pull-right"
                       style="margin-top: 5px;">
                        <b>Create</b>&nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                @endif
                @if((Auth::user()->hasRole('PA_USER')) && count($applications) > 0)
                    <button class="btn btn-warning btn-sm pull-right bulk-action"
                            style="margin-top: 5px;">
                        <b>Bulk Action</b>
                    </button>
                @endif
            </div>
            @endif
        </div>
        <table class="table table-striped table-hover " style="border: 1px solid lightgray;">
            <thead>
            <tr style="text-align: center;">
                <th style="text-align: center;">
                    @if((Auth::user()->hasRole('PA_USER')  && count($applications) > 0))
                        <input type="checkbox" id="select-all">
                    @endif
                </th>
                <th>Inward No</th>
                <th>Applicant Name</th>
                <th>Subject</th>
                <th>Status</th>
                <th>Reference No</th>
                <th>Date</th>
                <th>Documents</th>
                <th></th>
            </tr>
            </thead>
            @if(count($applications) > 0)
                <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td style="text-align: center;">
                            @if(Auth::user()->hasRole('PA_USER') && count($applications) > 0)
                                <input type="checkbox" name="{{$application->id}}" class="sub_chk"
                                       data-id="{{$application->id}}">
                            @endif
                        </td>
                        <td>{{$application->inward_no }}</td>
                        <td>{{$application->name }}</td>
                        <td>{{$application->subject }}</td>
                        <td>{{$application->status }}</td>
                        <td>{{$application->reference_no }}</td>
                        <td>{{$application->date }}</td>
                        <td>{{$application->documents }}</td>
                        <td>

                            @if(!Auth::user()->hasRole('USER'))
                            <a href="{{route('application.get',['id'=>$application->inward_no])}}" style="cursor: pointer;margin-left: 5px"
                               class="btn btn-group btn-sm pull-right">
                                <b>View <i class="fa fa-eye" aria-hidden="true"></i></b>
                            </a>
                            @endif
                            @if(Auth::user()->hasRole('PA_USER') && $application->status == 'CREATED')
                                <button data-toggle="modal" data-target="#paEditModal"
                                        data-application="{{$application}}" style="cursor: pointer"
                                        class="btn btn-warning btn-sm pull-right">
                                    <b>Action</b>
                                </button>
                            @endif
                            @if(Auth::user()->hasRole('CLERK') && $application->status == 'PA_USER UPDATED')
                                <a href="{{route('application.get',['id'=>$application->inward_no])}}" style="cursor: pointer"
                                   class="btn btn-warning btn-sm pull-right">
                                    <b>Action</b>
                                </a>
                            @endif
                            @if(Auth::user()->hasRole('DEPARTMENT_USER') && $application->status != 'COMPLETED')
                                <a href="{{route('application.get',['id'=>$application->inward_no])}}" style="cursor: pointer"
                                   class="btn btn-warning btn-sm pull-right">
                                    <b>Action</b>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @else
                <tbody>
                <tr>
                    <td colspan="9" style="text-align: center"><b style="color: red">No Records Found.</b></td>
                </tr>
                </tbody>
            @endif
        </table>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="paEditModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center">Application Information</h3>
                </div>
                <form action="{{route('application.remark')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="panel panel-default fadeInDown">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-5">Inward Number</label>
                                            <div class="col-md-7">
                                                <label for="name" class="col-md-8 control-label"
                                                       id="inward_id_display"> </label>
                                                <input type="text" name="inward_id" id="inward_id" hidden/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-5"> Reference Number</label>
                                            <div class="col-md-7">
                                                <label for="name" class="col-md-8 control-label"
                                                       id="reference_no_display"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-5">Application Name</label>
                                            <div class="col-md-7">
                                                <label for="name" class="col-md-8 control-label"
                                                       id="application_name_display"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="col-md-5"> Date</label>
                                            <div class="col-md-7">
                                                <label for="name" id="date_display" class="col-md-8 control-label"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="col-md-5">Status</label>
                                            <div class="col-md-7">
                                                <label for="name" class="col-md-8 control-label"
                                                       id="status_display" ></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-2">Documents</label>
                                            <div class="col-md-7">
                                                <label for="name" class="col-md-8 control-label"
                                                       id="documents_display"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-offset-2">
                                <input type="hidden" name="action" id="action" value="">

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
                                    <label for="name" class="col-md-4 control-label"> Remark</label>
                                    <div class="col-md-6">
                                        <input type="text" name="remark" id="remark" class="form-control"
                                               placeholder="Enter Remark" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="department" class="col-md-4 control-label"> Department</label>
                                    <div class="col-md-6">
                                        <select class="form-control dynamic-dept" id="department" name="department" required>
                                            <option value="" selected>Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="officer" class="col-md-4 control-label"> Officer</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="officer" name="officer" required  data-dependent="officer">
                                            <option value="">Select Officer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center !important;">
                        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal" style="margin-top: 10px">
                            Cancel
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                        <button type="submit" class="btn btn-md btn-success" style="margin-top: 10px">
                            Save
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="bulkModal">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center">Bulk Action</h3>
                </div>
                <form action="{{route('application.remarkMultiple')}}" method="post">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="col-md-offset-2">
                                {{ csrf_field() }}
                                <input name="appIds[]" type="text" id="appIds" hidden/>
                                {{--<div class="form-group">
                                    <label for="application_ids" class="col-md-4 control-label"></label>
                                    <div class="col-md-6">
                                      --}}{{--  <label for="name" class="control-label"
                                               id="inward_ids_display"> </label>--}}{{--
                                        <input name="appIds[]" type="text" id="appIds" hidden/>
                                    </div>
                                </div>--}}
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
                                    <label for="name" class="col-md-4 control-label"> Remark</label>
                                    <div class="col-md-6">
                                        <input type="text" name="remark" id="remark" class="form-control"
                                               placeholder="Enter Remark" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="department" class="col-md-4 control-label"> Department</label>
                                    <div class="col-md-6">
                                        <select class="form-control dynamic-dept-bulk" id="department" name="department" required>
                                            <option value="" selected>Select Department</option>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="officer" class="col-md-4 control-label"> Officer</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="officer-bulk" name="officer" required  data-dependent="officer">
                                            <option value="">Select Officer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center !important;">
                        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal" style="margin-top: 10px">Cancel
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                        <button type="submit" class="btn btn-md btn-success" style="margin-top: 10px">Save
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
