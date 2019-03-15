@extends('layouts.app')

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create Application</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{route('application.createNew')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label"> Inward Number</label>
                        <div class="col-md-6">
                            <input id="inward_no" type="text"
                                   class="form-control" name="inward_no"
                                   placeholder="Enter Inward Number"
                                   required autofocus>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Application Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text"
                                   class="form-control" name="name"
                                   placeholder="Enter Name"
                                   required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <label for="mobile" class="col-md-4 control-label">Mobile</label>

                        <div class="col-md-6">
                            <input id="mobile" type="text"
                                   class="form-control" name="mobile"
                                   placeholder="Enter Mobile"
                                   required autofocus>

                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="address" class="col-md-4 control-label">Address</label>
                        <div class="col-md-6">
                            <input id="address" type="text"
                                   class="form-control"
                                   name="address"
                                   placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="designation" class="col-md-4 control-label">District</label>
                        <div class="col-md-6">
                            <input id="district" type="text"
                                   class="form-control"
                                   name="district"
                                   placeholder="Enter District">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="designation" class="col-md-4 control-label">Taluka</label>
                        <div class="col-md-6">
                            <input id="taluka" type="text"
                                   class="form-control"
                                   name="taluka"
                                   placeholder="Enter Taluka">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a class="btn btn-warning" href="{{route('applications.index')}}">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
