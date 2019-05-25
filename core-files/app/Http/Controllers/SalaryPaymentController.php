<?php

namespace App\Http\Controllers;

use App\Model\EmployeeSalary;
use App\Model\PaymentMethod;
use App\Model\SalaryPayment;
use Illuminate\Http\Request;
use Auth;

class SalaryPaymentController extends Controller
{
    public function index(){
        $salary_payment = SalaryPayment::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.salary-payment.index')->with([
            'salary_payment'   => $salary_payment
        ]);
    }

    public function create(){
        $payment_methods = PaymentMethod::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.salary-payment.create')->with([
            'payment_methods'   => $payment_methods
        ]);
    }


    public function store(Request $request){
        $company_id = Auth::user()->company_id;
        $employee = Employee::where([
            ['company_id','=',$company_id],
            ['id','=',$request->employee_id],
        ])->firstOrFail();

        $employee_salary = EmployeeSalary::where([
            ['company_id','=',$company_id],
            ['employee_id','=',$employee->id],
            ['year','=',$request->year],
            ['month','=',$request->month],
        ])->first();

        $in_total = $employee->payScale ? $employee->payScale->gross_salary : 0;
        $net_salary = $in_total;

        if(!$employee_salary){
            $total_paid = 0;
            $total_due = $net_salary;
            $employee_salary = EmployeeSalary::create([
                'company_id'            => $company_id,
                'employee_id'           => $employee->id,
                'basic_salary'          => $employee->payScale->salary ?? 0,
                'net_salary'            => $net_salary,
                'month'                 => $request->month,
                'year'                  => $request->year,
                'paid_amount'           => $total_paid,
                'due_amount'            => $total_due,
            ]);
        }
        SalaryPayment::create([
            'employee_salary_id'    => $employee_salary->id,
            'payment_method_id'     => $request->payment_method_id,
            'company_id'            => $company_id,
            'amount'                => $request->amount,
            'payment_date'          => $request->payment_date
        ]);

    }
}
