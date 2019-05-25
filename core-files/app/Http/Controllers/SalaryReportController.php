<?php

namespace App\Http\Controllers;

use App\Model\Employee;
use Illuminate\Http\Request;

class SalaryReportController extends Controller
{
    public function index(){
        $employees = Employee::where('company_id',Auth::user()->company_id)->all();
        return view('admin.salary-report.index')->with([
            'employees' => $employees
        ]);
    }
}
