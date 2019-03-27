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
                            <label for="email" class="col-md-6 control-label text-right"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="{{ $settings[0]->enable == 1 ? true :false}}"
                                       name="email" id="email" class="setting_chk"
                                       data-name="{{ $settings[0]->name }}" onclick="emailCheck();"
                                        {{($settings[0]->enable == 1)?'checked="checked"':''}}>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="form-group">
                            <label for="sms" class="col-md-6 control-label text-right">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i> SMS</label>
                            <div class="col-md-6">
                                <input type="checkbox" value="{{ ($settings[1]->enable == 1) ? true :false}}"
                                       name="sms" id="sms" class="setting_chk"
                                       data-name="{{ $settings[1]->name}}" onclick="smsCheck()"
                                        {{($settings[1]->enable == 1)?'checked="checked"':''}}>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item" style="padding-bottom: 30px;">
                        <div class="form-group">
                            <label for="name" class="col-md-5 control-label"></label>
                            <div class="col-md-3">
                                <button class="btn btn-block btn-sm btn-success save-setting" type="submit">Save <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      <div class="row">
          <div class="col-md-12">
              <div class="panel panel-default">
                  <div class="panel-heading">SMS Setting</div>
                  <div class="panel-body">
                      <form class="form-horizontal" role="form" method="POST" action="{{route('settings.url')}}" method="POST">
                          {{ csrf_field() }}
                          <div class="form-group required">
                              <label for="url" class="col-md-1 control-label"> URL</label>
                              <div class="col-md-11">
                                  <input id="url" type="text"
                                         class="form-control" name="url"
                                         value="{{ $smsConfigUrl->param_value}}"
                                         placeholder="Enter URL"
                                         required autofocus>
                              </div>
                          </div>
                          <div class="form-group required">
                              <label for="username" class="col-md-1 control-label">UNM</label>
                              <div class="col-md-11">
                                  <input id="username" type="text"
                                         class="form-control" name="username"
                                         value="{{ $smsConfigUsername->param_value }}"
                                         placeholder="Enter username"
                                         required autofocus>
                              </div>
                          </div>
                          <div class="form-group required">
                              <label for="pass" class="col-md-1 control-label">PASS</label>
                              <div class="col-md-11">
                                  <input id="pass" type="text"
                                         class="form-control" name="pass"
                                         value="{{ $smsConfigPass->param_value }}"
                                         placeholder="Enter Password"
                                         required autofocus>
                              </div>
                          </div>
                          <div class="form-group required">
                              <label for="senderid" class="col-md-1 control-label"> Sender</label>
                              <div class="col-md-11">
                                  <input id="senderid" type="text"
                                         class="form-control" name="senderid"
                                         value="{{ $smsConfigSenderId->param_value }}"
                                         placeholder="Enter Sender"
                                         required autofocus>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-1 control-label">URL</label>
                              <div class="col-md-11">
                                  <p><b>{{ $finalString }}</b></p>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="name" class="col-md-5 control-label"></label>
                              <div class="col-md-3">
                                  <button type="submit" class="btn btn-block btn-sm btn-success save-setting">
                                      Save <i class="fa fa-floppy-o" aria-hidden="true"></i>
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
