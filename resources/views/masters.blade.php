@extends('layouts.app')

@section('content')
    <div class="col-md-12" style="margin-top: 0px;padding-top: 0px">
        <div class="col-md-12 tile-highlight text-center" style="margin-bottom: 5px">
            <div class="col-md-11">
                <p style="color: white;font-size: 20px;">{{$masterName}}</p>
            </div>
            <div class="col-md-1">
                <a href="{{route('master.details',['type' => strtolower($masterName), 'id'=>0])}}"
                   class="btn btn-default btn-sm pull-right"
                   style="margin-top: 5px">
                    <b>Create</b>&nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            </div>
        </div>
        <table class="table table-striped table-hover " style="border: 1px solid lightgray;">
            <thead>
            <tr>
                <th>#</th>
                @if($masterName != 'Action')
                    <th>Name</th>
                @endif
                @if($masterName == 'Action')
                    <th>Action</th>
                @endif
                @if($masterName == 'Action')
                    <th>User Type</th>
                @endif
                @if($masterName == 'Taluka')
                    <th>District</th>
                @endif
                <th></th>
            </tr>
            </thead>
            @if(!is_null($masters) && count($masters) > 0)
                <tbody>
                @foreach($masters as $master)
                    <tr>
                        <td style="font-family : 'Century-Gothic'">{{$master->id }}</td>
                        @if($masterName != 'Action')
                            <td>
                                {{$master->name }}
                            </td>
                        @endif
                        @if($masterName == 'Action')
                            <td>
                                {{$master->action }}
                            </td>
                        @endif
                        @if($masterName == 'Action')
                            <td>
                                {{ \App\Http\Controllers\ApplicationController::removeUnderscore($master->user_type )}}
                            </td>
                        @endif
                        @if($masterName == 'Taluka')
                            <td>
                                {{\App\Http\Controllers\MasterController::getDistrictName($master->district_id)}}
                            </td>
                        @endif
                        <td>
                            <button class="btn btn-danger btn-sm pull-right"
                                    data-typemaster="{{strtolower($masterName)}}"
                                    data-toggle="modal" data-target="#deleteMaster" data-masterid="{{$master->id}}">
                                Delete <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                             <a href="{{route('master.details',['type' => strtolower($masterName), 'id'=>$master->id])}}"
                                class="btn btn-primary btn-sm pull-right" style="margin-right: 5px">
                                 Edit
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                             </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            @else
                <tbody>
                <tr>
                    <td colspan="4" style="text-align: center"><b style="color: red">No Records Found.</b></td>
                </tr>
                </tbody>
            @endif
        </table>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteMaster">
        <div class="modal-dialog" role="master">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center">Delete confirmation</h3>
                </div>
                <form action="{{route('master.destroy')}}" method="post" id="master_delete_form">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <h4 class="text-center">Are you sure do you want to delete?</h4>
                        <input type="hidden" name="master_id" id="master_id" value="">
                        <input type="hidden" name="master_type" id="master_type" value="">
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
