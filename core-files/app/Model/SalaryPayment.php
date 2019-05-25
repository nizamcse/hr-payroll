<?php

namespace App\Model;

use App\Traits\CompanyTrait;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
    use CompanyTrait;
    protected $fillable = ['company_id','employee_salary_id','payment_method_id','amount','payment_status','payment_date'];

    public function setPaymentDateAttribute($value)
    {
        $this->attributes['payment_date'] = Carbon::parse($value)->format('Y-m-d');
    }
}
