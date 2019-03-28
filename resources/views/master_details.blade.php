@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{$masterName}}</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST"
                      action="{{is_null($master) ? route('master.create',['type' => strtolower($masterName)]) : route('master.update',['type' => strtolower($masterName),'id'=>$master->id])}}">
                    {{ csrf_field() }}
                    @if($masterName == 'Taluka')
                        <div class="form-group required">
                            <label for="district_id" class="col-md-4 control-label">District</label>
                            <div class="col-md-6">
                                <select name="district_id" id="district_id" class="form-control" required>
                                    <option value="">Select District</option>
                                    @foreach($districts as $district)
                                        <option value="{{$district->id}}" {{(!is_null($master) && ($master->district_id == $district->id)) ? 'selected': ''}}>{{$district->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    @if($masterName != 'Action')
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} required">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control" name="name"
                                       @if(!is_null($master)) value="{{ $master->name }}" @endif
                                       placeholder="Enter Name"
                                       required autofocus>
                            </div>
                        </div>
                    @endif


                    @if($masterName == 'Action')
                        <div class="form-group{{ $errors->has('action') ? ' has-error' : '' }} required">
                            <label for="action" class="col-md-4 control-label">Action</label>
                            <div class="col-md-6">
                                <input id="action" type="text"
                                       class="form-control" name="action"
                                       @if(!is_null($master)) value="{{ $master->action }}" @endif
                                       placeholder="Enter Action"
                                       required autofocus>
                            </div>
                        </div>
                    <div class="form-group required">
                        <label for="user_type" class="col-md-4 control-label">User Type</label>
                        <div class="col-md-6">
                            <select class="form-control" id="user_type" name="user_type" required>
                                <option value="">Select User Type</option>
                                <option value="PA_USER"  {{ ((!is_null($master)) &&($master->user_type == 'PA_USER')) ? 'selected="selected"' : '' }}>PA User</option>
                                <option value="CLERK"  {{ ((!is_null($master)) &&($master->user_type == 'CLERK')) ? 'selected="selected"' : '' }}>Clerk</option>
                                <option value="DEPARTMENT_USER"  {{ ((!is_null($master)) &&($master->user_type == 'DEPARTMENT_USER')) ? 'selected="selected"' : '' }}>Department User</option>
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a class="btn btn-warning" href="{{route('users.index')}}">
                                Cancel <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                            @if(!is_null($master))
                                <button type="submit" class="btn btn-primary">
                                    Update <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                </button>
                            @endif
                            @if(is_null($master))
                                <button type="submit" class="btn btn-primary">
                                    Create <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
