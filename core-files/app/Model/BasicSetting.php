<?php

namespace App\Model;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class BasicSetting extends Model
{
    use CompanyTrait;
    protected $fillable = ['in_time','exit_time','weekends'];
    protected $casts = [
        "weekends"  => "array"
    ];
}
