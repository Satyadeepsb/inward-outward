@extends('layouts.app')

@section('content')
    <div class="col-md-12" style="margin-top: 0px;padding-top: 0px">
        <div class="col-md-12 tile-highlight text-center" style="margin-bottom: 5px">
            <div class="col-md-12">
                <p style="color: white;font-size: 20px;">Settings</p>
            </div>
        </div>
        <div class="col-md-12" style="padding: 0px">
            <form id="settingsForm" action="{{route('settings.update')}}" method="POST">
                {{ csrf_field() }}
            <div class="list-group">
                <div class="list-group-item">
                    <div class="form-group">
                        <label for="email" class="col-md-6 control-label text-right">Email</label>
                        <div class="col-md-6">
                            <input type="checkbox" value="{{ $settings[0]->enable == 1 ? true :false}}"
                                   name="email" id="email" class="setting_chk"
                                   data-name="{{ $settings[0]->name }}"
                                    {{($settings[0]->enable == 1)?'checked="checked"':''}}>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="form-group">
                        <label for="sms" class="col-md-6 control-label text-right">SMS</label>
                        <div class="col-md-6">
                            <input type="checkbox" value="{{ ($settings[1]->enable == 1) ? true :false}}"
                                   name="sms" id="sms" class="setting_chk"
                                   data-name="{{ $settings[1]->name}}"
                                    {{($settings[1]->enable == 1)?'checked="checked"':''}}>
                        </div>
                    </div>
                </div>
                {{--<div class="list-group-item">
                    <div class="form-group">
                        <label for="name" class="col-md-5 control-label"></label>
                        <div class="col-md-3">
                            <button class="btn btn-block btn-sm btn-success save-setting" type="submit">Save</button>
                        </div>
                    </div>
                </div>--}}
            </div>
            </form>
    </div>



@endsection
