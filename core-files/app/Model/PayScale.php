<?php

namespace App\Model;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class PayScale extends Model
{
    use CompanyTrait;
    protected $fillable = ['name','basic','medical','house_rent','convey','food','gross_salary','ot_salary_per_hour','att_bonus'];
}
