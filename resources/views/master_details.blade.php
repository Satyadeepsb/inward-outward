@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">{{$masterName}}</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{route('user.update',['id'=>$master->id])}}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} required">
                        <label for="name" class="col-md-4 control-label">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text"
                                   class="form-control" name="name"
                                   value="{{ $master->name }}"
                                   placeholder="Enter Name"
                                   required autofocus>
                        </div>
                    </div>
                    {{--<div class="form-group required">
                        <label for="role" class="col-md-4 control-label">Role</label>
                        <div class="col-md-6">
                            <select class="form-control" id="role" name="role" value="{{ $master->role }}" required>
                                <option value="">Select User Role</option>
                                <option value="USER" {{ ($master->role == 'INWARD') ? 'selected="selected"' : '' }}>User</option>
                                <option value="PA_USER"  {{ ($master->role == 'PA_USER') ? 'selected="selected"' : '' }}>PA User</option>
                                <option value="CLERK"  {{ ($master->role == 'CLERK') ? 'selected="selected"' : '' }}>Clerk</option>
                                <option value="DEPARTMENT_USER"  {{ ($master->role == 'DEPARTMENT_USER') ? 'selected="selected"' : '' }}>Department User</option>
                            </select>
                        </div>
                    </div>--}}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a class="btn btn-warning" href="{{route('users.index')}}">
                                Cancel <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
