<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use App\Model\BasicSetting;
use App\Model\Company;
use App\Model\Employee;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Auth;

class AttendanceReportController extends Controller
{
    public function index(){
        $employees = Employee::where('company_id','=',Auth::user()->company_id)->get();
        return view('admin.attendance-report.index')->with([
            'employees' => $employees
        ]);
    }

    public function getAttendanceReport(Request $request){
        $company = Company::where('id','=',Auth::user()->company_id)->firstOrFail();
        $company_id = $company->id;
        $employee = Employee::where('company_id','=',$company->id)->where('id','=',$request->employee_id)->first();
        $start = Carbon::createFromDate($request->year,$request->month)->startOfMonth();
        $end = Carbon::createFromDate($request->year,$request->month)->endOfMonth();
        $dates = CarbonPeriod::create($start,$end);
        $settings = BasicSetting::where('company_id','=',$company->id)->first();
        if($employee)
        {
            $attendance = Attendance::where([
                ['employee_id','=', $employee->id]
            ])->whereBetween('attendance_date',[$start->format('Y-m-d'),$end->format('Y-m-d')])->get();
        }else{
            $attendance = Attendance::whereBetween('attendance_date',[$start->format('Y-m-d'),$end->format('Y-m-d')])->get();
        }

        return [
            'attendanceData'    => $attendance,
            'employee'    => $employee,
        ];
    }
}
