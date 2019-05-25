<?php

namespace App\Observers;

use App\Model\EmployeeSalary;
use App\Model\SalaryPayment;

class SalaryPaymentObserver
{
    /**
     * Handle the salary payment "created" event.
     *
     * @param  \App\Model\SalaryPayment  $salaryPayment
     * @return void
     */
    public function created(SalaryPayment $salaryPayment)
    {
        $employee_salary = EmployeeSalary::findOrFail($salaryPayment->employee_salary_id);
        $paid = $employee_salary->payments->sum('amount') ?? 0;
        $due = $employee_salary->net_salary - $paid;

        $current_due = $due;
        $current_paid = $paid;

        if($employee_salary->net_salary > $current_paid && $current_paid > 0){
            $status = 1;
        }else if($employee_salary->net_salary > $current_paid && $current_paid == 0){
            $status = 0;
        }
        else if($current_due <= 0){
            $status = 2;
        }

        $employee_salary->update([
            'paid_amount'   => $current_paid,
            'due_amount'    => $current_due,
            'status'        => $status ?? 0
        ]);

    }

    /**
     * Handle the salary payment "updated" event.
     *
     * @param  \App\Model\SalaryPayment  $salaryPayment
     * @return void
     */
    public function updated(SalaryPayment $salaryPayment)
    {
        $employee_salary = EmployeeSalary::findOrFail($salaryPayment->employee_salary_id);

        $paid = $employee_salary->payments->sum('amount') ?? 0;
        $due = $employee_salary->net_salary - $paid;

        $current_due = $due;
        $current_paid = $paid;

        if($employee_salary->net_salary > $current_paid && $current_paid > 0){
            $status = 1;
        }else if($employee_salary->net_salary > $current_paid && $current_paid == 0){
            $status = 0;
        }
        else if($current_due <= 0){
            $status = 2;
        }

        $employee_salary->update([
            'paid_amount'   => $current_paid,
            'due_amount'    => $current_due,
            'status'        => $status ?? 0
        ]);
    }

    /**
     * Handle the salary payment "deleted" event.
     *
     * @param  \App\Model\SalaryPayment  $salaryPayment
     * @return void
     */
    public function deleted(SalaryPayment $salaryPayment)
    {
        $employee_salary = EmployeeSalary::findOrFail($salaryPayment->employee_salary_id);

        $paid = $employee_salary->payments->sum('amount') ?? 0;
        $due = $employee_salary->net_salary - $paid;

        $current_due = $due;
        $current_paid = $paid;

        if($employee_salary->net_salary > $current_paid && $current_paid > 0){
            $status = 1;
        }else if($employee_salary->net_salary > $current_paid && $current_paid == 0){
            $status = 0;
        }
        else if($current_due <= 0){
            $status = 2;
        }

        $employee_salary->update([
            'paid_amount'   => $current_paid,
            'due_amount'    => $current_due,
            'status'        => $status ?? 0
        ]);
    }

    /**
     * Handle the salary payment "restored" event.
     *
     * @param  \App\Model\SalaryPayment  $salaryPayment
     * @return void
     */
    public function restored(SalaryPayment $salaryPayment)
    {
        //
    }

    /**
     * Handle the salary payment "force deleted" event.
     *
     * @param  \App\Model\SalaryPayment  $salaryPayment
     * @return void
     */
    public function forceDeleted(SalaryPayment $salaryPayment)
    {
        //
    }
}
