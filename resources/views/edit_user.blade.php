@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Update User</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{route('user.update',['id'=>$user->id])}}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} required">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                   class="form-control" name="name"
                                   value="{{ $user->name }}"
                                   placeholder="Enter Name"
                                   required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }} required">
                        <label for="mobile" class="col-md-4 control-label">Mobile</label>

                        <div class="col-md-6">
                            <input id="mobile" type="number"
                                   class="form-control" name="mobile"
                                   value="{{ $user->mobile }}"
                                   placeholder="Enter Mobile"
                                   required autofocus>

                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} required">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ $user->email }}"
                                   placeholder="Enter Email"
                                   required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="role" class="col-md-4 control-label">Role</label>
                        <div class="col-md-6">
                            <select class="form-control" id="role" name="role" value="{{ $user->role }}" required>
                                <option value="">Select User Role</option>
                                <option value="USER" {{ ($user->role == 'INWARD') ? 'selected="selected"' : '' }}>User</option>
                                <option value="PA_USER"  {{ ($user->role == 'PA_USER') ? 'selected="selected"' : '' }}>PA User</option>
                                <option value="CLERK"  {{ ($user->role == 'CLERK') ? 'selected="selected"' : '' }}>Clerk</option>
                                <option value="DEPARTMENT_USER"  {{ ($user->role == 'DEPARTMENT_USER') ? 'selected="selected"' : '' }}>Department User</option>
                            </select>
                        </div>
                    </div>
                    <div  class="form-group department-div">
                        <label for="department" class="col-md-4 control-label">Department</label>
                        <div class="col-md-6">
                            <select class="form-control" id="department" name="department">
                                <option value="0">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}" {{$user->department == $department->id ? 'selected': ''}}>{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group  required">
                        <label for="username" class="col-md-4 control-label">Username</label>
                        <div class="col-md-6">
                            <input id="username" type="text"  value="{{ $user->username }}"
                                   class="form-control" name="username"
                                   placeholder="Enter Username" required>
                        </div>
                    </div>

                    {{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                         <label for="password" class="col-md-4 control-label">Password</label>

                         <div class="col-md-6">
                             <input id="password" type="password"
                                    class="form-control" name="password"
                                    placeholder="Enter Password"
                                    value="{{ $user->password }}"
                                    required>

                             @if ($errors->has('password'))
                                 <span class="help-block">
                                         <strong>{{ $errors->first('password') }}</strong>
                                     </span>
                             @endif
                         </div>
                     </div>--}}
                    <div class="form-group">
                        <label for="location" class="col-md-4 control-label">Location</label>
                        <div class="col-md-6">
                            <select class="form-control" id="location" name="location">
                                <option value="0">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{$location->name}}"  {{$user->location == $location->name ? 'selected': ''}}>{{$location->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-4 control-label">Address</label>
                        <div class="col-md-6">
                            <input id="address" type="text"
                                   class="form-control"
                                   name="address"
                                   value="{{ $user->address }}"
                                   placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="designation" class="col-md-4 control-label">Designation </label>
                        <div class="col-md-6">
                            <select class="form-control" id="designation" name="designation">
                                <option value="0">Select Designation</option>
                                @foreach($designations as $designation)
                                    <option value="{{$designation->name}}" {{$user->designation == $designation->name ? 'selected': ''}}>{{$designation->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--<div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password"
                                   placeholder="Enter Confirm Password"
                                   class="form-control" name="password_confirmation" required>
                        </div>
                    </div>--}}
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a class="btn btn-warning" href="{{route('users.index')}}">
                                Cancel <i class="fa fa-times" aria-hidden="true"></i>
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update User <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
