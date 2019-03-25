@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Create User</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{route('user.save',['id'=>0])}}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} required">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                   class="form-control" name="name"
                                   value="{{ old('name') }}"
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
                                   value="{{ old('mobile') }}"
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
                                   value="{{ old('email') }}"
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
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Select User Role</option>
                                <option value="USER">User</option>
                                <option value="PA_USER">PA User</option>
                                <option value="CLERK">Clerk</option>
                                <option value="DEPARTMENT_USER">Department User</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department" class="col-md-4 control-label">Department</label>
                        <div class="col-md-6">
                            <select class="form-control" id="department" name="department" required>
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} required">
                        <label for="password" class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="form-control" name="password"
                                   placeholder="Enter Password"
                                   required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location" class="col-md-4 control-label">Location</label>
                        <div class="col-md-6">
                            <input id="location" type="text"
                                   class="form-control"
                                   name="location"
                                   value="{{ old('location') }}"
                                   placeholder="Enter Location">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-md-4 control-label">Address</label>

                        <div class="col-md-6">
                            <input id="address" type="text"
                                   class="form-control"
                                   name="address"
                                   value="{{ old('address') }}"
                                   placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="designation" class="col-md-4 control-label">Designation</label>
                        <div class="col-md-6">
                            <input id="designation" type="text"
                                   class="form-control"
                                   name="designation"
                                   value="{{ old('designation') }}"
                                   placeholder="Enter Designation">
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
                            <a href="{{route('users.index')}}" class="btn btn-warning">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Create User
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
