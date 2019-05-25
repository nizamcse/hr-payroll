<?php


Route::group(['middleware' => ['auth','super.admin']],function(){

    Route::get('/companies',[
        'uses'  => 'CompanyController@index',
        'as'    => 'companies'
    ]);


    Route::post('/create-company',[
        'uses'  => 'CompanyController@store',
        'as'    => 'store-company'
    ]);

    Route::get('/edit-company/{id}',[
        'uses'  => 'CompanyController@edit',
        'as'    => 'edit-company'
    ]);

    Route::post('/update-company/{id}',[
        'uses'  => 'CompanyController@update',
        'as'    => 'update-company'
    ]);

    Route::get('/delete-company/{id}',[
        'uses'  => 'CompanyController@delete',
        'as'    => 'delete-company'
    ]);


    Route::post('/update/company/user/password/{id}',[
        'uses'  => 'CompanyController@updateOrCreateAdmin',
        'as'    => 'update-company-user-pass'
    ]);

    Route::get('/update/company/user/password/{id}',function($id){
        $user = \App\User::where('company_id',$id)->where('company_admin',true)->first();
        return response()->json($user);
    });


    /**
     * Find Existing User
     */

    Route::post('/search/user',[
        'uses'  => 'CompanyController@findUser',
        'as'    => 'search-user'
    ]);
});

Route::group(['middleware' => ['auth']], function () {
    /**
     * Designation
     */
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/designations', [
        'uses' => 'DesignationController@index',
        'as' => 'designations'
    ]);

    Route::get('/designation/{id}', function ($id) {
        $designation = \App\Model\Designation::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($designation, 200);
    })->name('designation');

    Route::post('/designation/{id}', [
        'uses' => 'DesignationController@update',
        'as' => 'update-designation'
    ]);

    Route::post('/designation', [
        'uses' => 'DesignationController@store',
        'as' => 'create-designation'
    ]);

    Route::get('/delete-designation/{id}', [
        'uses' => 'DesignationController@delete',
        'as' => 'delete-designation'
    ]);

    /**
     * Pay Scale
     */

    Route::get('/pay-scales', [
        'uses' => 'PayScaleController@index',
        'as' => 'pay-scales'
    ]);

    Route::get('/pay-scale/{id}', function ($id) {
        $pay_scale = \App\Model\PayScale::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($pay_scale, 200);
    })->name('pay-scale');

    Route::post('/pay-scale/{id}', [
        'uses' => 'PayScaleController@update',
        'as' => 'update-pay-scale'
    ]);

    Route::post('/pay-scale', [
        'uses' => 'PayScaleController@store',
        'as' => 'create-pay-scale'
    ]);

    Route::get('/delete-pay-scale/{id}', [
        'uses' => 'PayScaleController@delete',
        'as' => 'delete-pay-scale'
    ]);

    /**
     * Deduction Type
     */

    Route::get('/deduction-types', [
        'uses' => 'DeductionTypeController@index',
        'as' => 'deduction-types'
    ]);

    Route::get('/deduction-type/{id}', function ($id) {
        $deduction_type = \App\Model\DeductionType::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($deduction_type, 200);
    })->name('deduction-type');

    Route::post('/deduction-type/{id}', [
        'uses' => 'DeductionTypeController@update',
        'as' => 'update-deduction-type'
    ]);

    Route::post('/deduction-type', [
        'uses' => 'DeductionTypeController@store',
        'as' => 'create-deduction-type'
    ]);

    Route::get('/delete-deduction-type/{id}', [
        'uses' => 'DeductionTypeController@delete',
        'as' => 'delete-deduction-type'
    ]);

    /**
     * Bonus
     */

    Route::get('/bonuses', [
        'uses' => 'BonusController@index',
        'as' => 'bonuses'
    ]);

    Route::get('/bonus/{id}', function ($id) {
        $bonus = \App\Model\Bonus::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($bonus, 200);
    })->name('bonus');

    Route::post('/bonus/{id}', [
        'uses' => 'BonusController@update',
        'as' => 'update-bonus'
    ]);

    Route::post('/bonus', [
        'uses' => 'BonusController@store',
        'as' => 'create-bonus'
    ]);

    Route::get('/delete-bonus/{id}', [
        'uses' => 'BonusController@delete',
        'as' => 'delete-bonus'
    ]);


    /**
     * Leave Type
     */
    Route::get('/leave-types', [
        'uses' => 'LeaveTypeController@index',
        'as' => 'leave-types'
    ]);

    Route::get('/leave-type/{id}', function ($id) {
        $leave_type = \App\Model\LeaveType::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($leave_type, 200);
    })->name('leave-type');

    Route::post('/leave-type/{id}', [
        'uses' => 'LeaveTypeController@update',
        'as' => 'update-leave-type'
    ]);

    Route::post('/leave-type', [
        'uses' => 'LeaveTypeController@store',
        'as' => 'create-leave-type'
    ]);

    Route::get('/delete-leave-type/{id}', [
        'uses' => 'LeaveTypeController@delete',
        'as' => 'delete-leave-type'
    ]);

    /**
     * Create Vacation Calender
     */

    Route::get('/vacations',[
        'uses'  => 'VacationController@index',
        'as'    => 'vacations'
    ]);

    Route::get('/create/vacation',[
        'uses'  => 'VacationController@create',
        'as'    => 'create-vacation'
    ]);

    Route::post('/create/vacation',[
        'uses'  => 'VacationController@store',
        'as'    => 'store-vacation'
    ]);

    Route::get('/edit/vacation/{id}',[
        'uses'  => 'VacationController@edit',
        'as'    => 'edit-vacation'
    ]);

    Route::post('/edit/vacation/{id}',[
        'uses'  => 'VacationController@update',
        'as'    => 'update-vacation'
    ]);

    Route::get('/delete/vacation/{id}',[
        'uses'  => 'VacationController@delete',
        'as'    => 'delete-vacation'
    ]);

    /**
     * Section
     */
    Route::get('/sections', [
        'uses' => 'SectionController@index',
        'as' => 'sections'
    ]);

    Route::get('/section/{id}', function ($id) {
        $section = \App\Model\Section::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($section, 200);
    })->name('section');

    Route::post('/section/{id}', [
        'uses' => 'SectionController@update',
        'as' => 'update-section'
    ]);

    Route::post('/section', [
        'uses' => 'SectionController@store',
        'as' => 'create-section'
    ]);

    Route::get('/delete-section/{id}', [
        'uses' => 'SectionController@delete',
        'as' => 'delete-section'
    ]);

    /**
     * Branch
     */
    Route::get('/branches', [
        'uses' => 'BranchController@index',
        'as' => 'branches'
    ]);

    Route::get('/branch/{id}', function ($id) {
        $section = \App\Model\Branch::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($section, 200);
    })->name('branch');

    Route::post('/branch/{id}', [
        'uses' => 'BranchController@update',
        'as' => 'update-branch'
    ]);

    Route::post('/branch', [
        'uses' => 'BranchController@store',
        'as' => 'create-branch'
    ]);

    Route::get('/delete-branch/{id}', [
        'uses' => 'BranchController@delete',
        'as' => 'delete-branch'
    ]);

    /**
     * Lines
     */
    Route::get('/lines', [
        'uses' => 'LineController@index',
        'as' => 'lines'
    ]);

    Route::get('/line/{id}', function ($id) {
        $section = \App\Model\Line::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($section, 200);
    })->name('line');

    Route::post('/line/{id}', [
        'uses' => 'LineController@update',
        'as' => 'update-line'
    ]);

    Route::post('/line', [
        'uses' => 'LineController@store',
        'as' => 'create-line'
    ]);

    Route::get('/delete-line/{id}', [
        'uses' => 'LineController@delete',
        'as' => 'delete-line'
    ]);

    /**
     * Payment Methods
     */

    /**
     * Lines
     */
    Route::get('/payment-methods', [
        'uses' => 'PaymentMethodController@index',
        'as' => 'payment-methods'
    ]);

    Route::get('/payment-method/{id}', function ($id) {
        $payment_method = \App\Model\PaymentMethod::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($payment_method, 200);
    })->name('payment-method');

    Route::post('/payment-method/{id}', [
        'uses' => 'PaymentMethodController@update',
        'as' => 'update-payment-method'
    ]);

    Route::post('/payment-method', [
        'uses' => 'PaymentMethodController@store',
        'as' => 'create-payment-method'
    ]);

    Route::get('/delete-payment-method/{id}', [
        'uses' => 'PaymentMethodController@delete',
        'as' => 'delete-payment-method'
    ]);

    /**
     * Employee
     */

    Route::get('/employees',[
        'uses'  => 'EmployeeController@index',
        'as'    => 'employees'
    ]);

    Route::get('/employee',[
        'uses'  => 'EmployeeController@create',
        'as'    => 'create-employee'
    ]);

    Route::post('/employee',[
        'uses'  => 'EmployeeController@store',
        'as'    => 'store-employee'
    ]);

    Route::get('/employee/{id}',[
        'uses'  => 'EmployeeController@employee',
        'as'    => 'show-employee'
    ]);

    Route::get('/edit/employee/{id}',[
        'uses'  => 'EmployeeController@edit',
        'as'    => 'edit-employee'
    ]);

    Route::post('/update/employee/{id}',[
        'uses'  => 'EmployeeController@update',
        'as'    => 'update-employee'
    ]);

    Route::get('/delete/employee/{id}',[
        'uses'  => 'EmployeeController@delete',
        'as'    => 'delete-employee'
    ]);

    /**
     * Device
     */
    Route::get('/devices', [
        'uses' => 'DeviceController@index',
        'as' => 'devices'
    ]);

    Route::get('/device/{id}', function ($id) {
        $section = \App\Model\Device::where([
            'company_id'    => \Illuminate\Support\Facades\Auth::user()->company_id,
            'id'            => $id
        ])->first();
        return response()->json($section, 200);
    })->name('device');

    Route::post('/device/{id}', [
        'uses' => 'DeviceController@update',
        'as' => 'update-device'
    ]);

    Route::post('/device', [
        'uses' => 'DeviceController@store',
        'as' => 'create-device'
    ]);

    Route::get('/delete-device/{id}', [
        'uses' => 'DeviceController@delete',
        'as' => 'delete-device'
    ]);

    /**
     * Update Log
     */
    Route::get('/update-logs', [
        'uses' => 'UpdateLogController@index',
        'as' => 'update-logs'
    ]);

    Route::post('/update-log', [
        'uses' => 'UpdateLogController@store',
        'as' => 'create-update-log'
    ]);

    Route::get('/delete-update-log/{id}', [
        'uses' => 'UpdateLogController@delete',
        'as' => 'delete-log'
    ]);


    /**
     * Salary
     */
    Route::get('/create/salary',[
        'uses'  => 'SalaryController@create',
        'as'    => 'create-salary'
    ]);


    Route::post('/get/salary-details',[
        'uses'  => 'SalaryController@getSalaryDetails',
        'as'    => 'get-salary-details'
    ]);

    /**
     * Employee Salary
     */
    Route::get('/employee-salaries',[
        'uses'  => 'EmployeeSalaryController@index',
        'as'    => 'employee-salaries'
    ]);

    Route::post('/create/salary',[
        'uses'  => 'EmployeeSalaryController@store',
        'as'    => 'store-salary'
    ]);
    Route::get('/employee/salary/{id}',[
        'uses'  => 'EmployeeSalaryController@show',
        'as'    => 'employee-salary'
    ]);

    Route::post('/get/employee-salaries',[
        'uses'  => 'EmployeeSalaryController@getSalaries',
        'as'    => 'get-employee-salaries'
    ]);

    Route::get('/get/employee-salaries',[
        'uses'  => 'EmployeeSalaryController@downloadSalaries',
        'as'    => 'download-employee-salaries'
    ]);

    Route::get('/delete/employee/salary/{id}',[
        'uses'  => 'EmployeeSalaryController@delete',
        'as'    => 'employee-salary-delete'
    ]);


    /**
     * Basic Settings
     */

    Route::get('/basic-settings',[
        'uses'  => 'BasicSettingController@index',
        'as'    => 'basic-settings'
    ]);

    Route::post('/basic-settings',[
        'uses'  => 'BasicSettingController@store',
        'as'    => 'basic-settings'
    ]);

    /**
     * Calculate Salary
     */

    Route::get('/calculate-attendance',[
        'uses'  => 'AttendanceLogController@showCalculateAttendance',
        'as'    => 'show-calculate-salary'
    ]);
    Route::post('/calculate-attendance',[
        'uses'  => 'AttendanceLogController@calculateAttendance',
        'as'    => 'calculate-attendance'
    ]);

    Route::get('/attendance-report',[
        'uses'  => 'AttendanceReportController@index',
        'as'    => 'attendance-report'
    ]);

    Route::post('/attendance-report',[
        'uses'  => 'AttendanceReportController@getAttendanceReport',
        'as'    => 'get-attendance-report'
    ]);

    /**
     * Job Card
     */

    Route::get('/create-job-card',[
        'uses'  => 'JobCardController@index',
        'as'    => 'create-job-card'
    ]);

    Route::post('/get-job-card',[
        'uses'  => 'JobCardController@show',
        'as'    => 'get-job-card'
    ]);

    Route::get('/download-job-card',[
        'uses'  => 'JobCardController@download',
        'as'    => 'download-job-card'
    ]);

    Route::get('/salary-dummy',[
        'uses'  => 'JobCardController@dummyDownload',
        'as'    => 'download-job-card'
    ]);


    /**
     * Salary Report
     */

    Route::get('/salary-report',[
        'uses'  => 'EmployeeSalaryController@showSalaryReport',
        'as'    => 'salary-reports'
    ]);

    Route::post('/salary-report',[
        'uses'  => 'EmployeeSalaryController@getSalaryReport',
        'as'    => 'get-salary-report'
    ]);


    /**
     * Importing Data
     */

    Route::get('insert-employee/{id}',function($id){
        $update_log = \App\Model\UpdateLog::find($id);
        if($update_log->remaining_data <= 0 || $update_log->company_id != \Illuminate\Support\Facades\Auth::user()->company_id)
            return redirect()->back();
        $employees = json_decode($update_log->json_data, true);
        $failed_data = json_decode($update_log->failed_data);
        $failed_data = $failed_data ?? [];
        $not_inserted = [];
        $start_index = $update_log->total_data - $update_log->remaining_data;
        $spliced_logs = array_splice($employees,$start_index,200);
        $company_id = $update_log->company_id;
        foreach ($spliced_logs as $employee){
            $employees_data = \App\Model\Employee::where('employee_id',$employee['EnrollNumber'])->where('company_id','=',$company_id)->first();
            if ($employees_data){
                $employees_data->update([
                    'employee_id'    => $employee['EnrollNumber'],
                    'name'           => $employee['Name'],
                    'company_id'     => $company_id
                ]);
            }else{
                \App\Model\Employee::create([
                    'employee_id'    => $employee['EnrollNumber'],
                    'name'           => $employee['Name'],
                    'company_id'     => $company_id
                ]);
            }
        }
        $failed_logs = array_merge($failed_data,$not_inserted);
        $current_remaining = $update_log->remaining_data > 200 ? $update_log->remaining_data - 200 : 0;
        $update_log->update([
            'remaining_data'    => $current_remaining,
            'failed_data'       => json_encode($failed_logs),
            'status'            => $current_remaining > 0 ? 'Not Completed' : 'Complete'
        ]);

        return redirect()->back();
    })->name('insert-employee');

    Route::get('insert-attendance/{id}',function($id){
        $update_log = \App\Model\UpdateLog::find($id);
        if($update_log->remaining_data <= 0 || $update_log->company_id != \Illuminate\Support\Facades\Auth::user()->company_id)
            return redirect()->back();
        $logs = json_decode($update_log->json_data, true);
        $failed_data = json_decode($update_log->failed_data);
        $failed_data = $failed_data ?? [];
        $not_inserted = [];
        $start_index = $update_log->total_data - $update_log->remaining_data;
        $spliced_logs = array_splice($logs,$start_index,200);
        $company_id = $update_log->company_id;

        foreach ($spliced_logs as $log){
            try{
                $employee = \App\Model\Employee::where('employee_id','=',$log['IndRegID'])->where('company_id','=',$company_id)->first();
                \App\Model\AttendanceLog::firstOrCreate([
                    'employee_id'           => $employee->id ?? null,
                    'device_employee_id'    => $log['IndRegID'],
                    'machine_id'            => $log['MachineNumber'],
                    'logging_time'          => \Carbon\Carbon::parse($log['DateTimeRecord'])->format('Y-m-d H:m:s'),
                    'company_id'            => $company_id
                ]);
            }catch (\Exception $e){
                $not_inserted[] = $log;
            }
        }
        $failed_logs = array_merge($failed_data,$not_inserted);
        $current_remaining = $update_log->remaining_data > 200 ? $update_log->remaining_data - 200 : 0;

        $update_log->update([
            'remaining_data'    => $current_remaining,
            'failed_data'       => json_encode($failed_logs),
            'status'            => $current_remaining > 0 ? 'Not Completed' : 'Complete'
        ]);

        return redirect()->back();
    })->name('insert-attendance');

    /**
     * Logout
     */

    Route::get('/logout',function(){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('test',function(){

    $in_time = \Carbon\Carbon::parse("00:40");
    $exit_time = \Carbon\Carbon::parse("00:30");
    $time_duration =  \App\Helper\TimeCalculator::timeDifference($in_time,$exit_time)->format('H:i:s');


});

Route::get('/import',function(){
    $data = [
        8580,
        8580,
        109309,
        109309,
        10310684,
        10310684,
        123,
        123,
        98,
        98,
        114,
        114,
        102,
        102,
        112,
        112,
        116,
        116,
        107,
        107,
    ];

    $data2 = [
        '2019-05-14 08:30:00 14:05:30',
        '2019-05-14 09:30:00 18:05:30',
        '2019-05-14 10:30:00 19:05:30',
        '2019-05-14 11:30:00 13:05:30',
        '2019-05-14 08:30:00 17:15:30',
        '2019-05-14 09:30:00 13:05:30',
        '2019-05-14 10:30:00 17:05:30',
        '2019-05-14 08:30:00 14:05:30',
        '2019-05-14 10:30:00 19:05:30',
        '2019-05-14 08:30:00 14:05:30',
        '2019-05-14 09:30:00 15:05:30',
        '2019-05-14 08:00:00 16:30:30',
        '2019-05-14 09:40:00 15:05:30',
        '2019-05-14 11:30:00 21:05:30',
        '2019-05-14 08:10:00 018:30:30',
        '2019-05-14 09:25:00 18:05:00',
        '2019-05-14 07:50:00 19:25:15',
        '2019-05-14 08:45:00 21:15:00',
        '2019-05-14 08:00:00 20:05:30',
        '2019-05-14  10:30:00 22:05:30',
    ];

    foreach ($data as $k => $d){
        $employee = \App\Model\Employee::where('employee_id','=',$d)->where('company_id','=',1)->first();
        $date_explode = explode(' ',$data2[$k]);


        \App\Model\AttendanceLog::create([
            'employee_id'       => $employee->id,
            'device_employee_id'    => $d,
            'machine_id'    => 1,
            'logging_time'  => $date_explode[0].' '.$date_explode[1],
            'company_id'    => $employee->company_id
        ]);

        \App\Model\AttendanceLog::create([
            'employee_id'       => $employee->id,
            'device_employee_id'    => $d,
            'machine_id'    => 1,
            'logging_time'  => $date_explode[0].' '.$date_explode[2],
            'company_id'    => $employee->company_id
        ]);
    }


    return \App\Model\AttendanceLog::all();


});

