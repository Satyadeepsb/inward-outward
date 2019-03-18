@extends('layouts.app')

@section('content')
    <div class="{{Auth::user()->hasRole('SUPERUSER') ? 'col-md-12':'col-md-10 col-md-offset-1' }}"
         style="margin-top: 0px;padding-top: 0px">
        <div class="col-md-12 tile-highlight text-center" style="margin-bottom: 5px">
            <div class="{{(((Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER')) && count($actions) > 0))? 'col-md-10':'col-md-11' }}">
                <p style="color: white;font-size: 20px">Applications</p>
            </div>
            <div class="col-md-1">
                <a href="{{route('application.create')}}"
                   class="btn btn-default btn-sm pull-right"
                   style="margin-top: 5px">
                    <b>Create</b>&nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            </div>
            @if((Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER')) && count($actions) > 0)
                <div class="col-md-1">
                    <button
                            class="btn btn-warning btn-sm pull-right bulk-action"
                            style="margin-top: 5px">
                        <b>Bulk Action</b>
                    </button>
                </div>
            @endif
        </div>
        <table class="table table-striped table-hover " style="border: 1px solid lightgray;">
            <thead>
            <tr style="text-align: center;">
                @if(Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER'))
                    <th style="text-align: center;"><input type="checkbox" id="select-all"></th>
                @endif
                <th>Inward No</th>
                <th>Application Name</th>
                <th>Status</th>
                <th>Date</th>
                <th>Documents</th>
                <th>Reference No</th>
                @if(Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER'))
                    <th></th>
                @endif
            </tr>
            </thead>
            @if(count($applications) > 0)
                <tbody>
                @foreach($applications as $application)
                    <tr>
                        @if(Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER'))
                            <td style="text-align: center;">
                                <input type="checkbox" name="{{$application->id}}" class="sub_chk"
                                       data-id="{{$application->id}}">
                            </td>
                        @endif
                        <td>{{$application->inward_no }}</td>
                        <td>{{$application->name }}</td>
                        <td>{{$application->status }}</td>
                        <td>{{$application->date }}</td>
                        <td>{{$application->documents }}</td>
                        <td>{{$application->reference_no }}</td>
                        @if(Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER'))
                            <td>
                                <button data-toggle="modal" data-target="#editModal"
                                        data-application="{{$application}}" style="cursor: pointer"
                                        class="btn btn-warning btn-sm pull-right">
                                    <b>Action</b>
                                </button>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            @else
                <tbody>
                <tr>
                    <td colspan="6" style="text-align: center"><b style="color: red">No Records Found.</b></td>
                </tr>
                </tbody>
            @endif
        </table>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
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
                            <div class="col-md-offset-2">
                                <input type="hidden" name="action" id="action" value="">
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label"> Inward Number</label>
                                    <div class="col-md-6">
                                        <label for="name" class="col-md-8 control-label" id="inward_id_display"> </label>
                                        <input type="text" name="inward_id" id="inward_id"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">Application Name</label>
                                    <div class="col-md-6">
                                        <label for="name" class="col-md-8 control-label" id="application_name_display"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label" >Status</label>
                                    <div class="col-md-6">
                                        <label for="name" id="status_display" class="col-md-8 control-label"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label"> Date</label>
                                    <div class="col-md-6">
                                        <label for="name" class="col-md-8 control-label" id="date_display"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label"> Documents</label>
                                    <div class="col-md-6">
                                        <label for="name"
                                               class="col-md-8 control-label" id="documents_display"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="action" class="col-md-4 control-label"> Action</label>
                                    <div class="col-md-6">
                                        <select multiple class="form-control" id="action" name="action" required>
                                            @foreach($actions as $action)
                                                <option value="{{$action->action}}">{{$action->action}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="department" class="col-md-4 control-label"> Department</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="department" name="department" required>
                                            @foreach($departments as $department)
                                                <option value="{{$department->name}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label"> Remark</label>
                                    <div class="col-md-6">
                                        <input type="text" name="remark" id="remark" class="form-control"
                                               placeholder="Enter Remark"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="user_id" class="col-md-4 control-label"> User</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="user_id" name="user_id">
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center !important;">
                        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success">Save</button>
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
                <form action="{{route('users.destroy','test')}}" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="col-md-offset-2">
                                <form class="form-horizontal" role="form" method="POST"
                                      action="{{route('application.createNew')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="action" id="action" value="">
                                    <input name="appIds[]" type="text" id="appIds" />
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center !important;">
                        <button type="button" class="btn btn-md btn-warning" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
