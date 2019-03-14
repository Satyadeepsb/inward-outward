@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create User</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
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
                           {{-- <div class="form-group">
                                <input type="text"  class="form-control" id="myDatePickerId" />
                            </div>--}}
                            <div class="form-group required">
                                <label for="myDatePickerId" class="col-md-4 control-label">Date</label>
                                <div class="col-md-6">
                                <div class="input-group datepick">
                                    <input type="text" class="form-control" placeholder="Select Date"
                                           name="myDatePickerId" id="myDatePickerId" required readonly>
                                    <div class="input-group-addon datepick" style="cursor: pointer">
                                        <i class="fa fa-calendar" aria-hidden="true" id="cal2"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                <label for="mobile" class="col-md-4 control-label">Mobile</label>

                                <div class="col-md-6">
                                    <input id="mobile" type="text"
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

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
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
                            <div class="form-group">
                                <label for="role" class="col-md-4 control-label">Role</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="role" name="role">
                                        <option value="">Select User Role</option>
                                        <option value="USER">User</option>
                                        <option value="PA_USER">PA User</option>
                                        <option value="CLERK">Clerk</option>
                                        <option value="DEPARTMENT_USER">Department User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password"
                                           placeholder="Enter Confirm Password"
                                           class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create User
                                    </button>
                                    <button type="reset" class="btn btn-warning">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
