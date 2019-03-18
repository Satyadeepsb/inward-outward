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
                    <ul style="list-style: none" class="pull-right" >
                        <li class="dropdown">
                            <a class="btn btn-warning btn-sm dropdown-toggle"
                               style="margin-top: 5px"
                               data-toggle="dropdown" href="#">
                                Bulk Action
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @foreach($actions as $action)
                                    <li>
                                        <a  data-toggle="modal" data-target="#editModal"
                                            data-action="{{$action->action}}" style="cursor: pointer">
                                            {{$action->action}}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <table class="table table-striped table-hover " style="border: 1px solid lightgray;">
            <thead>
            <tr style="text-align: center;">
                @if(Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER'))
                    <th>Select</th>
                @endif
                <th>Inward No</th>
                <th>Application Name</th>
                <th>Status</th>
                <th>Date</th>
                <th>Documents</th>
                <th></th>
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
                            <input type="checkbox" name="{{$application->id}}" value="{{$application->selected}}">
                        </td>
                        @endif
                        <td>{{$application->inward_no }}</td>
                        <td>{{$application->name }}</td>
                        <td>{{$application->status }}</td>
                        <td>{{$application->date }}</td>
                        <td>{{$application->documents }}</td>
                        <td>
                            <a class="btn btn-info btn-sm pull-right">
                                View
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                        @if(Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER'))
                            <td>
                                <ul style="list-style: none" class="pull-right">
                                    <li class="dropdown">
                                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                                            Action
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                                @foreach($actions as $action)
                                                <li>
                                                <a  data-toggle="modal" data-target="#editModal"
                                                    data-application="{{$application}}" data-action="{{$action->action}}" style="cursor: pointer">
                                                    {{$action->action}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center">Application Information</h3>
                </div>
                <form action="{{route('users.destroy','test')}}" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="col-md-12">
                          <div class="col-md-offset-2">
                              <form class="form-horizontal" role="form" method="POST" action="{{route('application.createNew')}}">
                                  {{ csrf_field() }}
                                  <input type="hidden" name="action" id="action" value="">
                                  <div class="form-group">
                                      <label for="name" class="col-md-4 control-label"> Inward Number</label>
                                      <div class="col-md-6">
                                          <label for="name" class="col-md-8 control-label">{{$application->id}} </label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-md-4 control-label">Application Name</label>
                                      <div class="col-md-6">
                                          <label for="name" class="col-md-8 control-label">{{$application->name}}</label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-md-4 control-label">Status</label>
                                      <div class="col-md-6">
                                          <label for="name" class="col-md-8 control-label">{{$application->status}}</label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-md-4 control-label"> Date</label>
                                      <div class="col-md-6">
                                          <label for="name" class="col-md-8 control-label">{{$application->date}}</label>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="name" class="col-md-4 control-label"> Documents</label>
                                      <div class="col-md-6">
                                          <label for="name" class="col-md-8 control-label">{{$application->documents}}</label>
                                      </div>
                                  </div>
                              </form>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="text-align: center !important;">
                        <button type="button" class="btn btn-md btn-warning"  data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
