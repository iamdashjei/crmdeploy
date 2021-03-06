<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('admin', function(){
    return view('layouts.admin_template');
});

Route::group(['middleware' => ['auth','role:admin|super admin']],function (){
    Route::get('/dashboard','EmployeePageController@dashboard');
    Route::get('/staff','EmployeePageController@agent');
    Route::get('/lgu','EmployeePageController@lgu');
    Route::get('/staff/profile/{id}','EmployeePageController@agentProfile');
    Route::post('/add-lgu','Lgu\LguController@addLgu');
});

Route::get('/create-ticket','Ticket\CreateTicketController@get_all_new_leads');

Route::group(['middleware' => ['auth','role:agent']],function (){
    Route::get('/staff/dashboard','AgentPageController@dashboard');
    Route::get('/staff/ticket','AgentPageController@ticket');
    Route::get('/staff/lgu','AgentPageController@lgu');
    Route::get('/staff/lgu/profile/{id}','Lgu\LguController@lgu_profile');
});

#superadmin login
Route::get('secure-login','SuperAdmin\SpLoginController@login_form');

Route::group(['middleware' => ['auth','role:super admin']],function(){
    Route::get('/super-admin/dashboard','SuperAdmin\SuperAdminController@dashboard');

    Route::get('/employee','SuperAdmin\SuperAdminController@employee');


    Route::get('super-admin/roles','SuperAdmin\SuperAdminController@roles')->name('role');
    Route::post('super-admin/roles','SuperAdmin\SuperAdminController@roleFormValidation');
    Route::post('/roles','SuperAdmin\SuperAdminController@deleteRole')->name('delete.role');
    Route::post('/roles-name','SuperAdmin\SuperAdminController@getRoleName');
    Route::post('/get-role-details','SuperAdmin\SuperAdminController@getRoleDetails');
    Route::post('/update-role-details','SuperAdmin\SuperAdminController@updateRoleDetails');

    Route::get('super-admin/permissions','SuperAdmin\SuperAdminController@permissions')->name('permission');
    Route::post('super-admin/permissions','SuperAdmin\SuperAdminController@permissionFormValidation');
    Route::post('/get-permission-details','SuperAdmin\PermissionController@getPermissionDetails');
    Route::post('/update-permission-details','SuperAdmin\PermissionController@updatePermission');
    Route::post('/delete-permission','SuperAdmin\PermissionController@deletePermission');

    Route::post('/add-new-call-center','CallCenter\CallCenterController@addNewCallCenter');
    Route::post('/get-call-center-value','CallCenter\CallCenterController@getCallCenterDetails');
    Route::post('/update-call-center-details','CallCenter\CallCenterController@updateCallCenterDetails');
    Route::post('/get-call-center-delete-value','CallCenter\CallCenterController@getCallCenterDetails');
    Route::post('/delete-call-center-details','CallCenter\CallCenterController@deleteCallCenter');
    Route::get('/call-center-profile/{id}','SuperAdmin\SuperAdminController@callCenterProfile')->name('callcenter.profile');

    Route::get('super-admin/rescueCenter','SuperAdmin\SuperAdminController@callCenter');
    Route::get('super-admin/lgu','SuperAdmin\SuperAdminController@lgu');
});

Route::group(['middleware' => ['auth','role:super admin|admin']], function (){
    Route::post('/add-employee','Employee\EmployeeController@addEmployee');
    Route::post('/get-employee-details','Employee\EmployeeController@getEmployeeDetails');
    Route::post('/update-employee-details','Employee\EmployeeController@updateEmployeeDetails');
    Route::post('/delete-employee','Employee\EmployeeController@deleteEmployee');
    Route::get('/employee/profile/{id}','SuperAdmin\SuperAdminController@employeeProfile');
});

Route::group(['middleware' => ['auth']],function (){
    Route::post('/provinces','address\AddressController@getProvinces');
    Route::post('/city','address\AddressController@getCities');

    Route::post('/update-ticket-status','Ticket\TicketController@update_ticket_status');
    Route::post('/assign-lgu-to-ticket','Ticket\TicketController@assign_lgu_to_ticket');
    Route::post('/display-lead-details','Ticket\TicketController@display_lead_details');
    Route::post('/relate-ticket','Ticket\TicketController@relate_tickets');
    Route::get('/ticket/{id}','AgentPageController@ticket_profile_page');
});
//Route::post('/call-user','AgentPageController@call_user');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test','Ticket\CreateTicketController@tester');


Route::group(['middleware' => ['cors'],'prefix' => 'v1'], function (){
    Route::post('/get-leads','Leads\LeadsController@save_leads');
    Route::get('/display-call-centers','SuperAdmin\SuperAdminController@show_call_center_list');
    Route::get('lgu-list','SuperAdmin\SuperAdminController@show_lgu_list');
    Route::post('/call-user','AgentPageController@call_user');
    Route::post('/events','Ticket\TicketController@twilio_callback');
    Route::post('/connect-to-lgu','Ticket\TicketController@connect_to_lgu');
});


Route::post(
    '/token',
    ['uses' => 'TokenController@newToken', 'as' => 'new-token']
);

Route::post(
    '/support/call',
    ['uses' => 'CallController@newCall', 'as' => 'new-call']
);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
