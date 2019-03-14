@extends('layouts.app')

@section('content')
    <div class="col-md-12" style="margin-top: 0px;padding-top: 0px">
        <div class="col-md-12 tile-highlight text-center" style="margin-bottom: 5px">
            <div class="col-md-11">
                <p style="color: white;font-size: 20px">Users</p>
            </div>
            <div class="col-md-1">
                <a href="/user/0"
                   class="btn btn-default btn-sm pull-right"
                   style="margin-top: 5px">
                    <b>Create</b>&nbsp;<i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            </div>
        </div>
        <table class="table table-striped table-hover " style="border: 1px solid lightgray;">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{$user->id }}</td>
                <td>{{$user->name }}</td>
                <td>{{$user->email }}</td>
                <td>{{$user->role }}</td>
                <td>
                    <button class="btn btn-primary btn-sm pull-right">
                        Edit
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm pull-right"
                            data-toggle="modal" data-target="#deleteUser" data-userid="{{$user->id}}">
                        Delete <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="deleteUser">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title text-center">Delete confirmation</h3>
                </div>
                <form action="{{route('users.destroy','test')}}" method="post">
                    {{method_field('delete')}}
                    {{csrf_field()}}
                <div class="modal-body">
                    <h4 class="text-center">Are you sure do you want to delete?</h4>
                    <input type="hidden" name="user_id" id="user_id" value="">
                </div>
                <div class="modal-footer" style="text-align: center !important;">
                    <button type="button" class="btn btn-md btn-success" data-dismiss="modal">No, Cancel</button>
                    <button type="submit" class="btn btn-md btn-warning">Yes, Delete</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
