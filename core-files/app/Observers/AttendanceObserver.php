<?php

namespace App\Observers;

use App\Helper\TimeCalculator;
use App\Model\Attendance;
use App\Model\BasicSetting;
use App\Model\Employee;
use Carbon\Carbon;
use Config;

class AttendanceObserver
{
    /**
     * Handle the attendance "creating" event.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return void
     */
    public function creating(Attendance $attendance)
    {
        $employee = Employee::where([
            ['company_id','=', $attendance->company_id,],
            ['id','=',$attendance->employee_id]
        ])->firstOrFail();

        $attendance->in_status = $attendance->in_time ? TimeCalculator::getInStatus($employee,$attendance) : null;
        $exit_status = $attendance->exit_time ?  TimeCalculator::getExitStatus($employee,$attendance) : null;

        $attendance->out_status = $exit_status ? $exit_status['status'] : $exit_status;
        $attendance->overtime = $exit_status ? $exit_status['overtime'] : 0;
        if($employee->count_ot)
        {
            $attendance->overtime_wage = $exit_status ? $employee->payScale ? $employee->payScale->ot_salary_per_hour*$exit_status['ot_hour'] : 0 : 0;
        }
        else
            $attendance->overtime_wage = 0;
        $time_difference = TimeCalculator::timeDifference($attendance);
        if($time_difference)
            $attendance->measurement_quantity = $time_difference->hour + ($time_difference->minute/100);
        else
            $attendance->measurement_quantity = 0;



    }

    /**
     * Handle the attendance "updating" event.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return void
     */

    public function updating(Attendance $attendance)
    {
        $employee = Employee::where([
            ['company_id','=', $attendance->company_id,],
            ['id','=',$attendance->employee_id]
        ])->firstOrFail();

        $attendance->in_status = $attendance->in_time ? TimeCalculator::getInStatus($employee,$attendance) : null;
        $exit_status = $attendance->exit_time ?  TimeCalculator::getExitStatus($employee,$attendance) : null;

        $attendance->out_status = $exit_status ? $exit_status['status'] : $exit_status;
        $attendance->overtime = $exit_status ? $exit_status['overtime'] : 0;
        if($employee->count_ot){
            $pay_scale = $employee->payScale;
            $attendance->overtime_wage = $exit_status ? $exit_status['overtime'] * $pay_scale->ot_salary_per_hour ?? 0 : 0;
        }
        else
            $attendance->overtime_wage = 0;
        $time_difference = TimeCalculator::timeDifference($attendance);
        if($time_difference)
            $attendance->measurement_quantity = $time_difference->hour + ($time_difference->minute/100);
        else
            $attendance->measurement_quantity = 0;
    }

    /**
     * Handle the attendance "created" event.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return void
     */
    public function created(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the attendance "updated" event.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return void
     */
    public function updated(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the attendance "deleted" event.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return void
     */
    public function deleted(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the attendance "restored" event.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return void
     */
    public function restored(Attendance $attendance)
    {
        //
    }

    /**
     * Handle the attendance "force deleted" event.
     *
     * @param  \App\Model\Attendance  $attendance
     * @return void
     */
    public function forceDeleted(Attendance $attendance)
    {
        //
    }
}
