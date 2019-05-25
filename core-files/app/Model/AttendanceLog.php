<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $fillable = ['employee_id','device_employee_id','machine_id','logging_time','company_id'];
    protected $appends = ['time'];

    protected function getTimeAttribute(){
        return Carbon::parse($this->logging_time)->format('H:m');
    }

    public function employee(){
        return $this->belongsTo('App\Model\Employee','employee_id','id');
    }

}
