@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Edit Application</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{route('application.update')}}">
                    {{ csrf_field() }}
                    <input id="id" type="text" name="id" value="{{$application->id}}" hidden>
                    <div class="form-group required">
                        <label for="name" class="col-md-4 control-label"> Inward Number</label>
                        <div class="col-md-6">
                            <input id="inward_no" type="text" readonly
                                   class="form-control" name="inward_no"
                                   value="{{$application->inward_no}}"
                                   placeholder="Enter Inward Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reference_no" class="col-md-4 control-label"> Reference Number</label>
                        <div class="col-md-6">
                            <input id="reference_no" type="text" value="{{$application->reference_no}}"
                                   class="form-control" name="reference_no"
                                   placeholder="Enter Reference Number">
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="name" class="col-md-4 control-label">Applicant Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" value="{{$application->name}}"
                                   class="form-control" name="name"
                                   placeholder="Enter Name"
                                   required autofocus>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="subject" class="col-md-4 control-label">Subject</label>
                        <div class="col-md-6">
                            <input id="subject" type="text" value="{{$application->subject}}"
                                   class="form-control" name="subject"
                                   placeholder="Enter Subject"
                                   required autofocus>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="date" class="col-md-4 control-label">Date</label>
                        <div class="col-md-6">
                            <div class="input-group datepick">
                                <input type="text" class="form-control" placeholder="Select Date"
                                       name="date" id="date" value="{{$application->date}}" readonly>
                                <div class="input-group-addon datepick" style="cursor: pointer">
                                    <i class="fa fa-calendar" aria-hidden="true" id="cal2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }} required">
                        <label for="mobile" class="col-md-4 control-label">Mobile</label>

                        <div class="col-md-6">
                            <input id="mobile" type="text"
                                   class="form-control" name="mobile" value="{{$application->mobile}}"
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
                                   class="form-control" value="{{$application->address}}"
                                   name="address"
                                   placeholder="Enter Address">
                        </div>
                    </div>
                    {{--<div class="form-group">
                        <label for="district" class="col-md-4 control-label">District</label>
                        <div class="col-md-6">
                            <select name="district" id="district" class="form-control dynamic">
                                <option value="">Select District</option>
                                @foreach($data['districts'] as $district)
                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taluka" class="col-md-4 control-label">Taluka</label>
                        <div class="col-md-6">
                            <select name="taluka" id="taluka" class="form-control"
                                    data-dependent="taluka">
                                <option value="">Select Taluka</option>
                            </select>
                        </div>
                    </div>--}}
                   {{-- <div class="form-group">
                        <label for="documents" class="col-md-4 control-label">Documents</label>
                        <div class="col-md-6">
                            <select name="documents[]" multiple id="documents" name="documents" class="form-control">
                                @foreach($data['documents'] as $key => $value)
                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>--}}

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <a class="btn btn-warning" href="{{route('applications.index')}}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
