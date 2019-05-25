<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use App\Model\AttendanceLog;
use App\Model\Employee;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class AttendanceLogController extends Controller
{
    public function index(){
        return view('admin.calculate-attendance');
    }

    public function showCalculateAttendance(){
        return view('admin.attendance.calculate');
    }

    public function calculateAttendance(Request $request){
        ini_set('max_execution_time', 1000);
        ini_set('memory_limit','512M');
        $start = Carbon::createFromDate($request->year,$request->month)->startOfMonth();
        $end = Carbon::createFromDate($request->year,$request->month)->endOfMonth();
        $dates = CarbonPeriod::create($start,$end);
        $data = [];

        foreach ($dates as $date) {

            $logging_date = $date->format('Y-m-d');
            $employee_logs = AttendanceLog::whereDate('logging_time', '=', $logging_date)->where('device_employee_id', '!=', null)->orderBy('logging_time', 'ASC')->get()->groupBy('device_employee_id');
            $log_data = [];
            foreach ($employee_logs as $k =>  $log){
                $total_log = count($log);
                if($total_log > 0){
                    $start = $log[0]->time;
                    $end = $total_log > 1 ? $log[$total_log-1]->time : null;
                    $employee = Employee::where('employee_id','=',$k)->first();
                    $att_data = [
                        'attendance_date'   => $logging_date,
                        'in_time'           => $start,
                        'exit_time'         => $end,
                        'employee_id'       => $employee ? $employee->id : null,
                        'device_employee_id'       => $k,
                        ''
                    ];
                    $attendance = Attendance::where('device_employee_id','=',$k)->where('attendance_date','=',$logging_date)->first();
                    if($attendance){
                        try{
                            $attendance->update($att_data);
                        }catch(\Exception $e){
                            return $e->getMessage();
                        }
                    }else{
                        try{
                            Attendance::create($att_data);
                        }catch(\Exception $e){
                            return $e->getMessage();
                        }
                    }
                }
            }
        }
        return redirect()->route('attendance-report')->with([
            'status'    => true,
            'message'   => 'Successfully calculated attendance data'
        ]);
    }
}
