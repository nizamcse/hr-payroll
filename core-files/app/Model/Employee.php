<?php

namespace App\Model;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use CompanyTrait;
    protected $fillable = [
        'name',
        'employee_id',
        'contact_no',
        'designation_id',
        'section_id',
        'line_id',
        'branch_id',
        'in_time',
        'exit_time',
        'shift',
        'salary',
        'salary_type',
        'minimum_working_hour',
        'company_id',
        'joining_date',
        'status',
        'count_ot',
        'pay_scale_id'
    ];


    protected $appends = ['salary_base'];

    public function section(){
        return $this->belongsTo('App\Model\Section','section_id','id');
    }
    public function branch(){
        return $this->belongsTo('App\Model\Branch','branch_id','id');
    }
    public function line(){
        return $this->belongsTo('App\Model\Line','line_id','id');
    }

    public function designation(){
        return $this->belongsTo('App\Model\Designation','designation_id','id');
    }

    public function payScale(){
        return $this->belongsTo('App\Model\PayScale','pay_scale_id','id');
    }

    public function rosters(){
        return $this->hasMany('App\Model\Roster','employee_id','id');
    }

    public function leaves(){
        return $this->hasMany('App\Model\Leave','employee_id','id');
    }

    public function leaveTypes(){
        return $this->belongsToMany('App\Model\LeaveType','employee_leave_types','employee_id','leave_type_id')
            ->withPivot('max_allowed_days')->withTimestamps();
    }

    public function annualLeaves(){
        return $this->belongsToMany('App\Model\EmployeeAnnualLeave','employee_leave_types','employee_id','leave_type_id')
            ->withPivot('max_allowed_days')->withTimestamps();
    }

    public function salaries(){
        return $this->hasMany('App\Model\EmployeeSalary','employee_id','id');
    }

    protected function getSalaryBaseAttribute(){
        $salary_types = ['Hourly','Monthly'];
        return $salary_types[$this->salary_type -1] ?? '';
    }

    public function setCountOtAttribute($value)
    {
        $this->attributes['count_ot'] = $value ? 1 : 0;
    }



}
