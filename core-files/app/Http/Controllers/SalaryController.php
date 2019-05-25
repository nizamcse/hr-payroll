<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use App\Model\BasicSetting;
use App\Model\Bonus;
use App\Model\DeductionType;
use App\Model\Employee;
use App\Model\EmployeeSalary;
use App\Model\MonthlyLeave;
use App\Model\MonthlyVacation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Auth;

class SalaryController extends Controller
{

    public function index($company_id){
        $employee = Employee::where('company_id','=',$company_id)->get();
        return view('admin.salary.index')->with([
            'employees' => $employee
        ]);
    }

    public function create(){
        $company_id = Auth::user()->company_id;
        $employee = Employee::where('company_id','=',$company_id)->get();
        $bonuses = Bonus::where('company_id','=',$company_id)->get();
        $deductions = DeductionType::where('company_id','=',$company_id)->get();
        return view('admin.salary.create')->with([
            'employees' => $employee,
            'deductions'    => $deductions,
            'bonuses'   => $bonuses
        ]);
    }

    public function store(Request $request){
        return $request->all();
    }

    public function getSalaryDetails(Request $request){
        $company_id = Auth::user()->company_id;
        $start = Carbon::createFromDate($request->year,$request->month)->startOfMonth();
        $end = Carbon::createFromDate($request->year,$request->month)->endOfMonth();
        $settings = BasicSetting::where('company_id','=',$company_id)->first();
        $employee = Employee::where([
            'company_id'    => $company_id,
            'id'            => $request->employee_id
        ])->first();

        $employee_id = $employee->id;

        $monthly_vacation =  MonthlyVacation::where([
            ['month','=',$start->month],
            ['year','=',$start->year],
        ])->get();

        // Attendance

        $attendance = Attendance::where([
            ['employee_id','=', $employee->id]
        ])->whereBetween('attendance_date',[$start->format('Y-m-d'),$end->format('Y-m-d')])->get();

        // Late Attendance

        $late_attendance = 0;
        $overtime_wage = $attendance ? $attendance->sum('overtime_wage') : 0;
        if($employee->in_time){
            $late_attendance = Attendance::where([
                ['in_status','like','%Late%'],
            ])->whereBetween('attendance_date',[$start->format('Y-m-d'),$end->format('Y-m-d')])->get();
        }

        // Total Working Hour

        $total_working_hour = $attendance->sum('measurement_quantity');

        $period = CarbonPeriod::create($start,$end);
        $days = [];
        foreach ($period as $date) {
            $days[] = $date->format('w');
        }
        $days_without_weekend = array_diff($days,$settings->weekends);

        $total_weekends = count($days) - count($days_without_weekend);

        // Counting Leaves

        $total_leaves = MonthlyLeave::whereHas('leave',function($query) use ($employee_id){
            $query->where('employee_id','=',$employee_id);
        })->where([
            ['month' ,'=', $start->month],
            ['year'  ,'=', $start->year]
        ])->sum('days');

        $days_without_vacation_leave_and_weekends = count($days_without_weekend) - $monthly_vacation->sum('days') - $total_leaves;



        $minimum_working_hour = $employee->minimum_working_hour * $days_without_vacation_leave_and_weekends;

        $basic_salary = $employee->payScale ? $employee->payScale->basic : 0;
        $overtime_salary = 0;
        if($employee->count_ot){
            $overtime_salary = $attendance ? $attendance->sum('overtime_wage') : 0;
        }
        $es = EmployeeSalary::where([
            ['company_id','=',$company_id],
            ['employee_id','=',$employee->id],
            ['year','=',$request->year],
            ['month','=',$request->month],
        ])->first();


        if($es){
            $deductions_occured = [];
            $received_bonuses = [];
            foreach ($es->bonuses as $b){
                $b->amount = $b->pivot->amount ?? 0;
                $received_bonuses[] = $b;
            }

            foreach ($es->deductions as $d){
                $d->amount = $d->pivot->amount ?? 0;
                $deductions_occured[] = $d;
            }

        }

        else{
            $received_bonuses = [];
            $deductions_occured = [];
        }

        $attended = $attendance ? $attendance->count() : 0;
        $att_bonus = $employee->payScale ? $employee->payScale->att_bonus : 0;

        if($attended < $days_without_vacation_leave_and_weekends){
            $att_bonus = 0;
        }

        return response()->json([
            'totalDays'         => count($days),
            'lately_attend'     => $late_attendance,
            'total_attend'      => $attendance ? $attendance->count() : 0,
            'should_attend'     => $days_without_vacation_leave_and_weekends,
            'total_leaves'      => $total_leaves,
            'total_working_hour'=> $total_working_hour,
            'minimum_working_hour'=> $minimum_working_hour,
            'vacation'          => $monthly_vacation->sum('days'),
            'extra_working_hour'=> $attendance ? $attendance->sum('overtime') : 0,
            'total_weekends'    => $total_weekends,
            'basic_salary'      => $basic_salary,
            'overtime_salary'   => $overtime_salary,
            'gross_salary'  =>  $employee->payScale ? $employee->payScale->gross_salary : 0,
            'name' => $employee->payScale ? $employee->payScale->name : 0,
            'basic' => $employee->payScale ? $employee->payScale->basic : 0,
            'house_rent' => $employee->payScale ? $employee->payScale->house_rent : 0,
            'convey' => $employee->payScale ? $employee->payScale->convey : 0,
            'medical' => $employee->payScale ? $employee->payScale->medical : 0,
            'food' => $employee->payScale ? $employee->payScale->food : 0,
            'received_bonuses' => $received_bonuses,
            'deductions_occured' => $deductions_occured,
            'att_bonus'     => $att_bonus
        ],200);
    }
}
