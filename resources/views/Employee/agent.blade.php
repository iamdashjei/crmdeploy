@extends('layouts.adminDashboardTemplate')

@section('extra_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('title')
    Admin | Staff
@endsection
@section('extra_stylesheet')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" rel="stylesheet">
@endsection
@section('page_header')
    Staff <button type="button" class="btn bg-purple" data-toggle="modal" data-target="#create-staff"><i class="fa fa-plus"></i> Add New</button>
@endsection
@section('main_content')
    <div class="box">
        <div class="box-body">
            <table id="agents-list" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th width="10%">Date Registered</th>
                    <th width="20%">Full Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th width="15%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->created_at}}</td>
                        <td>
                            {{ucfirst($employee->firstname).' '.ucfirst($employee->lastname)}}
                        </td>
                        <td>{{$employee->email}}</td>
                        <td>{{$employee->username}}</td>
                        <td>{{ucfirst($employee->role_name)}}</td>
                        <td>
                            <a href="{{url('/agent/profile/'.$employee->id)}}"><button type="button" class="btn btn-success edit-btn" title="View"><i class="fa fa-eye"></i></button></a>
                            <button type="button" class="btn btn-primary edit-employee" title="Edit" data-toggle="modal" data-target="#edit_employee" value="{{$employee->id}}"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger delete-employee-btn" title="Delete" data-toggle="modal" data-target="#delete_employee" value="{{$employee->id}}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th width="10%">Date Registered</th>
                    <th width="20%">Full Name</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th width="15%">Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <div class="modal fade" id="create-staff">
        <div class="modal-dialog modal-lg">
            <form method="post" id="add-staff">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Employee</h4>
                    </div>

                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <div class="row">
                                <span class="col-lg-4">
                                    <div class="form-group">
                                        <div class="firstname">
                                            <label for="firstname">First name</label> <span class="required">*</span>
                                            <input type="text" name="firstname" id="firstname" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                                <span class="col-lg-4">
                                    <div class="form-group">
                                        <div class="middlename">
                                            <label for="middlename">Middle name</label>
                                            <input type="text" name="middlename" id="middlename" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                                <span class="col-lg-4">
                                    <div class="form-group">
                                        <div class="lastname">
                                            <label for="lastname">Last name</label><span class="required">*</span>
                                            <input type="text" name="lastname" id="lastname" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">
                                    <div class="form-group">
                                        <div class="email">
                                            <label for="email">Email</label><span class="required">*</span>
                                            <input type="text" name="email" id="email" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                                <span class="col-lg-6">
                                    <div class="form-group">
                                        <div class="username">
                                            <label for="username">Username</label><span class="required">*</span>
                                            <input type="text" name="username" id="username" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                            </div>

                            <div class="row">
                                <span class="col-lg-6">
                                    <div class="form-group">
                                        <div class="password">
                                            <label for="password">Password</label><span class="required">*</span>
                                            <input type="password" name="password" id="password" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                                <span class="col-lg-6">
                                    <div class="form-group">
                                        <div class="password_confirmation">
                                            <label for="password_confirmation">Confirm Password</label><span class="required">*</span>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="role">
                                                <label for="role">Select Role</label>
                                                <select name="role" class="form-control role" id="role">
                                                    <option></option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="callcenter" value="{{$cc_id}}"/>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-purple"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--Edit Staff--}}
    <div class="modal fade" id="edit_employee">
        <div class="modal-dialog modal-lg">
            <form method="post" id="update-staff">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Employee</h4>
                    </div>

                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="user_value" id="user_value"/>
                        <div class="form-group">
                            <div class="row">
                                <span class="col-lg-4">
                                    <div class="form-group">
                                        <div class="edit_firstname">
                                            <label for="edit_firstname">First name</label> <span class="required">*</span>
                                            <input type="text" name="edit_firstname" id="edit_firstname" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                                <span class="col-lg-4">
                                    <div class="form-group">
                                        <div class="edit_middlename">
                                            <label for="edit_middlename">Middle name</label>
                                            <input type="text" name="edit_middlename" id="edit_middlename" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                                <span class="col-lg-4">
                                    <div class="form-group">
                                        <div class="edit_lastname">
                                            <label for="edit_lastname">Last name</label><span class="required">*</span>
                                            <input type="text" name="edit_lastname" id="edit_lastname" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-lg-6">
                                    <div class="form-group">
                                        <div class="edit_email">
                                            <label for="edit_email">Email</label><span class="required">*</span>
                                            <input type="text" name="edit_email" id="edit_email" class="form-control"/>
                                        </div>
                                    </div>
                                </span>
                                <span class="col-lg-6">
                                    <div class="form-group">
                                            <div class="edit_role">
                                                <label for="edit_role">Select Role</label>
                                                <select name="edit_role" class="form-control role" id="edit_role">
                                                    <option></option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->name}}">{{ucfirst($role->name)}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                </span>
                            </div>

                            <input type="hidden" name="old_role" id="old_role"/>
                            <input type="hidden" name="edit_callcenter" value="{{$cc_id}}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-purple"><i class="fa fa-check"></i> Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal modal-danger fade" id="delete_employee">
        <div class="modal-dialog">
            <form method="post" id="delete-staff">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Delete Role</h4>
                    </div>
                    <div class="modal-body">
                        <span>Are you sure you want to delete User: <b class="user_name"></b>?</span>
                    </div>
                    <input type="hidden" name="user_delete" class="user_delete"/>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline" name="submit" value=""><i class="fa fa-trash"></i> Delete</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('extra_script')
    <!-- DataTables -->
    <script src="{{asset('/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{asset('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- FastClick -->
    <script src="{{asset('/bower_components/fastclick/lib/fastclick.js')}}"></script>

    <!-- growl notification -->
    <script src="{{asset('bower_components/remarkable-bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <script src="{{asset('/js/employee.js')}}"></script>

    <script>
        $(function () {
            $('#agents-list').DataTable()
        })
    </script>
@endsection
