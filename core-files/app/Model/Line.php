<?php

namespace App\Model;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use CompanyTrait;
    protected $fillable = ['name','company_id','status'];
}
