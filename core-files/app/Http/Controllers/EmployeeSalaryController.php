<?php

namespace App\Http\Controllers;

use App\Model\Attendance;
use App\Model\BasicSetting;
use App\Model\Company;
use App\Model\Employee;
use App\Model\EmployeeSalary;
use App\Model\MonthlyLeave;
use App\Model\MonthlyVacation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use PDF;
use Auth;

class EmployeeSalaryController extends Controller
{
    public function index(){
        $employees = Employee::where('company_id','=',Auth::user()->company_id)->get();
        return view('admin.employee-salary.index')->with([
            'employees' => $employees
        ]);
    }

    public function showSalaryReport(){
        $employees = Employee::where('company_id','=',Auth::user()->company_id)->get();
        return view('admin.salary.report')->with([
            'employees' => $employees
        ]);
    }

    public function getSalaryReport(Request $request){

        $company_id = Auth::user()->company_id;
        $wheres = [
            ['company_id','=',$company_id]
        ];

        if($request->month){
            $wheres[] = ['month','=',$request->month];
        }

        if($request->year){
            $wheres[] = ['year','=',$request->year];
        }

        if($request->employee_id){
            //$wheres[] = ['employee_id','=',$request->employee_id];
        }


        $monthly_vacation = MonthlyVacation::where($wheres)->get();

        $employees = Employee::with(['payScale','designation','line','salaries' => function($q) use($wheres){
            $q->where($wheres);
        }])->whereHas('salaries',function($q) use($wheres){
            $q->where($wheres);
        })->orderBy('designation_id','ASC')->get();
        //$employee_salaries = EmployeeSalary::with(['employee'])->where($wheres)->paginate(10);
        $company = Company::findOrFail($company_id);
        return view('admin.salary.salary-report')->with([
            'employees'     => $employees,
            'company'               => $company,
            'month'                 => $request->month,
            'year'                  => $request->year,
            'holidays'              => $monthly_vacation
        ]);
    }


    public function getSalaries(Request $request){
        $company_id = Auth::user()->company_id;
        $wheres = [
            ['company_id','=',$company_id]
        ];

        if($request->month){
            $wheres[] = ['month','=',$request->month];
        }

        if($request->year){
            $wheres[] = ['year','=',$request->year];
        }

        if($request->employee_id){
            $wheres[] = ['employee_id','=',$request->employee_id];
        }
        $employee_salaries = EmployeeSalary::with(['employee'])->where($wheres)->paginate(10);
        return response()->json($employee_salaries,200);
    }

    public function downloadSalaries (Request $request,$company_id){
        $company_id = Auth::user()->company_id;
        $wheres = [
            ['company_id','=',$company_id]
        ];

        if($request->month){
            $wheres[] = ['month','=',$request->month];
        }

        if($request->year){
            $wheres[] = ['year','=',$request->year];
        }

        if($request->employee_id){
            $wheres[] = ['employee_id','=',$request->employee_id];
        }
        $employee_salaries = EmployeeSalary::with(['employee'])->where($wheres)->paginate(10);
        $company = Company::findOrFail($company_id);
        return view('pdf.salary-sheet', [
            'employee_salaries'     => $employee_salaries,
            'company'               => $company,
            'month'                 => $request->month,
            'year'                  => $request->year
        ]);

        $pdf = PDF::loadView('pdf.salary-sheet', [
            'employee_salaries'     => $employee_salaries,
            'company'               => $company,
            'month'                 => $request->month,
            'year'                  => $request->year
        ])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    public function store(Request $request){
        $company_id = Auth::user()->company_id;
        $date = Carbon::createFromDate($request->year,$request->month);
        $start = Carbon::createFromDate($request->year,$request->month)->startOfMonth();
        $end = Carbon::createFromDate($request->year,$request->month)->endOfMonth();
        $employee = Employee::where([
            ['company_id','=',$company_id],
            ['id','=',$request->employee_id],
        ])->firstOrFail();

        $settings = BasicSetting::where('company_id','=',$company_id)->first();

        $monthly_vacation =  MonthlyVacation::where([
            ['company_id','=',$company_id],
            ['month','=',$request->month],
            ['year','=',$request->year],
        ])->get();

        $deductions = collect($request->deductions);
        $bonuses = collect($request->bonuses);
        $in_total = $employee->payScale ? $employee->payScale->gross_salary : 0;

        $attendences = Attendance::where([
            ['employee_id','=', $employee->id]
        ])->whereBetween('attendance_date',[$start->format('Y-m-d'),$end->format('Y-m-d')])->get();

        $total_attends = $attendences ? $attendences->count(): 0;
        $total_ot = $attendences ? $attendences->sum('overtime'): 0;
        $total_ot_amount = $attendences ? $attendences->sum('overtime_wage'): 0;

        $net_salary = $in_total + $bonuses->sum('amount') - $deductions->sum('amount') + $total_ot_amount;

        $employee_salary = EmployeeSalary::where([
            ['company_id','=',$company_id],
            ['employee_id','=',$employee->id],
            ['year','=',$request->year],
            ['month','=',$request->month],
        ])->first();

        $period = CarbonPeriod::create($start,$end);
        $days = [];
        foreach ($period as $date) {
            $days[] = $date->format('w');
        }

        $days_without_weekend = array_diff($days,$settings->weekends);

        $total_weekends = count($days) - count($days_without_weekend);

        $total_leaves = MonthlyLeave::whereHas('leave',function($query) use ($employee){
            $query->where('employee_id','=',$employee->id);
        })->where([
            ['month' ,'=', $request->month],
            ['year'  ,'=', $request->year]
        ])->sum('days');

        $working_days = count($days_without_weekend) - $monthly_vacation->sum('days');
        $absents = $working_days - $total_attends - $total_leaves;

        if($employee_salary){
            $total_paid = $employee_salary->payments->sum('amount') ?? 0;
            $total_due = $net_salary - $employee_salary->payments->sum('amount') ?? 0;
            $employee_salary->update([
                'company_id'            => $company_id,
                'employee_id'           => $employee->id,
                'basic_salary'          => $employee->payScale->basic ?? 0,
                'bonuses_amount'        => $bonuses->count() ? $bonuses->sum('amount') : 0,
                'deductions_amount'     => $deductions->count() ? $deductions->sum('amount') : 0,
                'net_salary'            => $net_salary,
                'month'                 => $date->month,
                'year'                  => $date->year,
                'holidays'              => $monthly_vacation->sum('days'),
                'weekends'              => $total_weekends,
                'total_attend'          => $total_attends,
                'total_leave'           => $total_leaves,
                'absent'                => $absents,
                'working_days'          => $working_days,
                'total_ot_amount'       => $total_ot_amount,
                'total_ot'              => $total_ot,
                'paid_amount'           => $total_paid,
                'due_amount'            => $total_due,
                'att_bonus'             => $absents <=0 ? $employee->payScale->att_bonus ?? 0 : 0,
            ]);

            $received_bonuses = $employee_salary->bonuses;
            $deductions_occured = $employee_salary->deductions;
        }

        else{
            $total_paid = 0;
            $total_due = $net_salary;
            $employee_salary = EmployeeSalary::create([
                'company_id'            => $company_id,
                'employee_id'           => $employee->id,
                'basic_salary'          => $employee->payScale->basic ?? 0,
                'bonuses_amount'        => $bonuses->count() ? $bonuses->sum('amount') : 0,
                'deductions_amount'     => $deductions->count() ? $deductions->sum('amount') : 0,
                'net_salary'            => $net_salary,
                'month'                 => $date->month,
                'year'                  => $date->year,
                'holidays'              => $monthly_vacation->sum('days'),
                'weekends'              => $total_weekends,
                'total_attend'          => $total_attends,
                'total_leave'           => $total_leaves,
                'absent'                => $absents,
                'working_days'          => $working_days,
                'total_ot_amount'       => $total_ot_amount,
                'total_ot'              => $total_ot,
                'paid_amount'           => $total_paid,
                'due_amount'            => $total_due,
                'att_bonus'             => $absents <=0 ? $employee->payScale->att_bonus ?? 0 : 0,
            ]);
        }

        $bonusses_data = [];
        foreach ($bonuses as $bonus){
            $bonusses_data[$bonus['id']] = [
                'amount'    => $bonus['amount']
            ];
        }
        $employee_salary->bonuses()->sync($bonusses_data);
        $deductions_data = [];
        foreach ($deductions as $deduction){
            $deductions_data[$deduction['id']] = [
                'amount'    => $deduction['amount']
            ];
        }
        $employee_salary->deductions()->sync($deductions_data);


        return redirect()->route('employee-salary',['id' => $employee_salary->id]);
    }

    public function show($id){


        $employee_salary = EmployeeSalary::with(['employee.payScale'])->where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->firstOrFail();
        $company = Company::where('id','=',Auth::user()->company_id)->first();
        return view('admin.employee-salary.show')->with([
            'employee_salary'   => $employee_salary,
            'company'           => $company,
            'employee'          => $employee_salary->employee
        ]);
    }
}
