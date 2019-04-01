@extends('layouts.app')

@section('content')
    <div class="{{Auth::user()->hasRole('SUPERUSER') ? 'col-md-12':'col-md-10 col-md-offset-1' }}"
         style="margin-top: 0px;padding-top: 0px">
        <div class="col-md-12 tile-highlight text-center" style="margin-bottom: 5px">
            <div class="{{((Auth::user()->hasRole('PA_USER') || Auth::user()->hasRole('SUPERUSER') || Auth::user()->hasRole('INWARD')))? 'col-md-11': 'col-md-12'}}">
                <p style="color: white;font-size: 20px">Change Password</p>
            </div>
        </div>
        <div>
            <form class="form-horizontal" role="form" method="POST" action="{{route('change-password.change')}}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} required">
                    <label for="oldPassword" class="col-md-4 control-label">Old Password</label>
                    <div class="col-md-6">
                        <input id="oldPassword" type="password"
                               class="form-control" name="oldPassword"
                               placeholder="Enter Old Password"
                               required autofocus>

                        @if ($errors->has('oldPassword'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('oldPassword') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }} required">
                    <label for="newPassword" class="col-md-4 control-label">New Password</label>

                    <div class="col-md-6">
                        <input id="newPassword" type="password"
                               class="form-control" name="newPassword"
                               placeholder="Enter New Password"
                               required autofocus>
                        @if ($errors->has('newPassword'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('newPassword') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} required">
                    <label for="confirmPassword" class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="confirmPassword" type="password"
                               class="form-control"
                               name="confirmPassword"
                               placeholder="Enter Confirm Password"
                               required>
                        @if ($errors->has('confirmPassword'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('confirmPassword') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <a class="btn btn-warning" href="{{route('users.index')}}">
                            Cancel <i class="fa fa-times" aria-hidden="true"></i>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Change <i class="fa fa-key" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
