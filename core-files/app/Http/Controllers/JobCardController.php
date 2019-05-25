<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use App\Model\BasicSetting;
use App\Model\Employee;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Auth;
use PDF;

class JobCardController extends Controller
{
    public function index(){
        $employees = Employee::all();
        return view('admin.job-card.index')->with([
            'employees' => $employees
        ]);
    }

    public function show(Request $request){
        $start = Carbon::createFromDate($request->year,$request->month)->startOfMonth()->format('Y-m-d');
        $end = Carbon::createFromDate($request->year,$request->month)->endOfMonth()->format('Y-m-d');
        $employee = Employee::with(['payScale', 'designation', 'line', 'branch', 'section'])->where('id', '=', $request->employee_id)->first();
        $attendances= Attendance::whereBetween('attendance_date',[$start,$end])->where('employee_id', '=', $request->employee_id)->get();
        $period = CarbonPeriod::create($start,$end);
        $settings = BasicSetting::where('company_id','=',Auth::user()->company_id)->first();
        $days = [];
        foreach ($period as $date) {

            $w = count($settings->weekends) ? in_array($date->format('w'), $settings->weekends): false;

            $day = [
                'main_date'  => $date->format('l, d-M-Y'),
                'date'       => $date->format('Y-m-d'),
                'weekend'    => $date->format('w'),
                'is_weekend' => $w
            ];
            $attendance = $attendances->filter(function ($item) use($day){
                return $item->attendance_date == $day['date'];
            })->first();

            $day['attendance']=$attendance;
            $days[]= $day;
        }
        $pdf = PDF::loadView('admin.job-card.job-card', [
            'employee'  => $employee,
            'days'      => $days,
            'settings'  => $settings,

        ]);
        return $pdf->download('job-card.pdf');

        return view('admin.job-card.job-card')
            ->withEmployee($employee)
            ->withDays($days)
            ->withSettings($settings)
            ->withAttendances($attendances);
    }

    public function download(Request $request){}

    public function dummyDownload(){
//        return view('admin.salary.salary-dummy');
        $pdf = PDF::loadView('admin.salary.salary-dummy')->setPaper('a4', 'landscape');
        return $pdf->download('job-card.pdf');
    }
}
