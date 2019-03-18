@extends('layouts.app')

@section('content')
    <div class="{{Auth::user()->hasRole('SUPERUSER') ? 'col-md-12':'col-md-10 col-md-offset-1' }}"
         style="margin-top: 0px;padding-top: 0px">
        <div class="col-md-12 tile-highlight text-center" style="margin-bottom: 5px">
            <div class="col-md-11">
                <p style="color: white;font-size: 20px">Applications</p>
            </div>
            <div class="col-md-1">
                <a href="{{route('application.create')}}"
                   class="btn btn-default btn-sm pull-right"
                   style="margin-top: 5px">
                    <b>Create</b>&nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            </div>
        </div>
        <table class="table table-striped table-hover " style="border: 1px solid lightgray;">
            <thead>
            <tr>
                @if(!Auth::user()->hasRole('USER'))
                <th>Select</th>
                @endif
                <th>Inward No</th>
                <th>Application Name</th>
                <th>Status</th>
                <th>Date</th>
                <th>Documents</th>
                <th></th>
                @if(!Auth::user()->hasRole('USER'))
                    <th></th>
                @endif
            </tr>
            </thead>
            @if(count($applications) > 0)
                <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td style="text-align: center;">
                            <input type="checkbox" >
                        </td>
                        <td>{{$application->inward_no }}</td>
                        <td>{{$application->name }}</td>
                        <td>{{$application->status }}</td>
                        <td>{{$application->date }}</td>
                        <td>{{$application->documents }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm pull-right">
                                Edit
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        </td>
                        @if(!Auth::user()->hasRole('USER'))
                            <td>
                                <ul style="list-style: none" class="pull-right">
                                    <li class="dropdown">
                                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                                            Action
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">Submenu 1-1</a></li>
                                            <li><a href="#">Submenu 1-2</a></li>
                                            <li><a href="#">Submenu 1-3</a></li>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteUser">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center">Delete confirmation</h3>
                </div>
                <form action="{{route('users.destroy','test')}}" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <h4 class="text-center">Are you sure do you want to delete?</h4>
                        <input type="hidden" name="user_id" id="user_id" value="">
                    </div>
                    <div class="modal-footer" style="text-align: center !important;">
                        <button type="button" class="btn btn-md btn-success" data-dismiss="modal">No, Cancel</button>
                        <button type="submit" class="btn btn-md btn-warning">Yes, Delete</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
