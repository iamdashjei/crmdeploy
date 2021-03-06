@extends('layouts.admin_template')

@section('title')
    Super Admin | LGU
@endsection
@section('extra_stylesheet')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('/bower_components/select2/dist/css/select2.min.css')}}">
    <link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css" rel="stylesheet">
@endsection
@section('page_header')
    LGU <button type="button" class="btn bg-purple" data-toggle="modal" data-target="#callCenterModal"><i class="fa fa-plus"></i> Add New</button>
@endsection
@section('variable_menu')
    <li><a href="{{url('/super-admin/dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li><a href="{{url('employee')}}"><i class="fa fa-user-plus"></i> <span>Employee</span></a></li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bank"></i><span>Roles</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            <ul class="treeview-menu">
                <li><a href="{{url('/super-admin/roles')}}">View Roles</a></li>
                <li><a href="/super-admin/permissions">View Permissions</a></li>
            </ul>
        </a>
    </li>
    <li><a href="{{url('/super-admin/rescueCenter')}}"><i class="fa fa-phone-square"></i> <span>Rescue Centers</span></a></li>
    <li class="active"><a href="{{url('/super-admin/lgu')}}"><i class="fa fa-bank"></i> <span>LGUs</span></a></li>
@endsection
@section('main_content')
    <div class="box">
        <div class="box-body">
            <table id="lgu-list" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th width="8%">Date Registered</th>
                    <th width="8%">Station Name</th>
                    <th width="10%">Department</th>
                    <th width="20%">Address</th>
                    <th width="8%">Contact Person</th>
                    <th width="8%">Contact No.</th>
                    <th width="13%">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th width="8%">Date Registered</th>
                    <th width="8%">Station Name</th>
                    <th width="10%">Department</th>
                    <th width="20%">Address</th>
                    <th width="8%">Contact Person</th>
                    <th width="8%">Contact No.</th>
                    <th width="13%">Action</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
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
            $('#lgu-list').DataTable({
            })
        })
    </script>
@endsection
