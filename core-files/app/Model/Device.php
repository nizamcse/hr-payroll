<?php

namespace App\Model;

use App\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use CompanyTrait;
    protected $fillable = ['name','ip_address','device_no','port'];

    public function scopeExcludeTimeStamps($query)
    {
        return $query->select( ['id','name','ip_address','device_no','port'] );
    }
}
