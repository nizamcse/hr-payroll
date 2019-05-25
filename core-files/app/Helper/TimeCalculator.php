<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 02-May-19
 * Time: 12:43 AM
 */

namespace App\Helper;


use App\Model\Attendance;
use App\Model\BasicSetting;
use App\Model\Employee;
use App\Model\Vacation;
use Carbon\Carbon;

class TimeCalculator
{
    public static function timeDifference(Attendance $attendance){

        if(!$attendance->in_time || !$attendance->exit_time)
            return null;

        $in_time = Carbon::parse($attendance->in_time);
        $exit_time = Carbon::parse($attendance->exit_time);

        if($in_time->gt($exit_time)){
            $in_time_minute = $in_time->minute > 0 ? 60 : 0;
            $in_time_hour = $in_time->minute > 0 ? 23 : 00;

            $hour = $in_time_hour - $in_time->hour;
            $minute = $in_time_minute - $in_time->minute;

            $final_minute = ($exit_time->minute + $minute) % 60;
            $final_hour = $hour + $exit_time->hour + (int)(($exit_time->minute + $minute) / 60);

            $result =  Carbon::parse($final_hour.":".$final_minute);
            return $result;

        }else{
            $exit_time_minute = $exit_time->minute < $in_time->minute ? $exit_time->minute + 60 : $exit_time->minute;
            $exit_time_hour = $exit_time->minute < $in_time->minute ? $exit_time->hour - 1 : $exit_time->hour;

            $hour = $exit_time_hour - $in_time->hour;
            $minute = $exit_time_minute - $in_time->minute;

            $result =  Carbon::parse($hour.":".$minute);
            return $result;
        }
    }


    public static function getInStatus(Employee $employee,Attendance $attendance){
        $in_status = null;
        $in_time = Carbon::parse($attendance->in_time);
        $attendance_date = Carbon::parse($attendance->attendance_date);
        $settings = BasicSetting::where([['company_id','=', $attendance->company_id,]])->first();
        if($employee->in_time && $employee->exit_time){
            //$office_in_time = Carbon::parse($employee->in_time);
            $office_in_time = Carbon::parse($settings->in_time);
        }else{
            $office_in_time = Carbon::parse($settings->in_time);
        }

        if($office_in_time->gt($in_time) || $office_in_time->eq($in_time)){
            $week_day = $attendance_date->format('w');
            $vacation = Vacation::where('from_date','>=',$attendance_date)->where('to_date','<=',$attendance_date)->first();
            if(in_array($week_day,$settings->weekends) || $vacation)
                $in_status = "In-WH-Stand";
            else{
                $in_status = "In-Stand";
            }
        }

        else if(($office_in_time->hour < $in_time->hour) || $in_time->minute >=5){
            $week_day = $attendance_date->format('w');
            $vacation = Vacation::where('from_date','>=',$attendance_date)->where('to_date','<=',$attendance_date)->first();
            if(in_array($week_day,$settings->weekends) || $vacation)
                $in_status = "In-WH-Late";
            else{
                $in_status = "In-Late";
            }
        }

        else{
            $week_day = $attendance_date->format('w');
            $vacation = Vacation::where('from_date','>=',$attendance_date)->where('to_date','<=',$attendance_date)->first();
            if(in_array($week_day,$settings->weekends) || $vacation)
                $in_status = "In-Ex-WH-Grace";
            else{
                $in_status = "In-Grace";
            }
        }

        return $in_status;

    }

    public static function getExitStatus(Employee $employee,Attendance $attendance){
        $exit_status = null;
        if(!$attendance->in_time || !$attendance->exit_time)
            return null;
        $settings = BasicSetting::where([['company_id','=', $attendance->company_id,]])->first();
        $settings_exit_time = Carbon::parse($settings->exit_time);
        $exit_time = Carbon::parse($attendance->exit_time);
        $attendance_date = Carbon::parse($attendance->attendance_date);
        $overtime = 0;
        $final_overtime_hour = 0;


        if($settings_exit_time->gt($exit_time)){
            $week_day = $attendance_date->format('w');
            $vacation = Vacation::where('from_date','>=',$attendance_date)->where('to_date','<=',$attendance_date)->first();

            if(in_array($week_day,$settings->weekends) || $vacation)
                $exit_status = "HW-Early-Leave";
            else
                $exit_status = "Early-Leave";

        }elseif($settings_exit_time->lt($exit_time)){
            $overtime = $exit_time->diff($settings_exit_time)->format('%h:%I');
            $week_day = $attendance_date->format('w');
            $vacation = Vacation::where('from_date','>=',$attendance_date)->where('to_date','<=',$attendance_date)->first();
            if(in_array($week_day,$settings->weekends) || $vacation)
                if($employee->count_ot){
                    $exit_status = "Out-HW-OT-Leave";
                }else{
                    $exit_status = "Out-HW-ExHr-Leave";
                }
            else{
                if($employee->count_ot){
                    $exit_status = "Out-OT-Leave";
                }else{
                    $exit_status = "Out-ExHr-Leave";
                }
            }


        }
        if($overtime){

            $time = Carbon::parse($overtime);
            $final_overtime_hour = $time->hour;
            if($time->minute >=55)
                $final_overtime_hour++;
        }

        return [
            'status'    => $exit_status,
            'overtime'  => $final_overtime_hour
        ];
    }

}