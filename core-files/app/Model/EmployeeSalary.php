<?php

namespace App\Model;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use CompanyTrait;
    protected $fillable = [
        'employee_id','company_id','month','year','basic_salary','bonuses_amount','deductions_amount','funds_amount','net_salary','status',
        'total_attend','leave','weekends','absent','holidays','working_days', 'total_ot_amount', 'total_ot','paid_amount','due_amount','att_bonus'
    ];

    public function employee(){
        return $this->belongsTo('App\Model\Employee','employee_id','id');
    }

    public function bonuses(){
        return $this->belongsToMany('App\Model\Bonus','salary_bonuses','salary_id','bonus_id')->withPivot('amount')->withTimestamps();
    }
    public function deductions(){
        return $this->belongsToMany('App\Model\DeductionType','salary_deductions','salary_id','deduction_id')->withPivot('amount')->withTimestamps();
    }


    public function payments(){
        return $this->hasMany('App\Model\SalaryPayment','employee_salary_id','id');
    }



}
