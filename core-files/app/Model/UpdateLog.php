<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class UpdateLog extends Model
{
    protected $fillable = ['data_type','json_data','company_id','total_data','status','remaining_data','failed_data','device_id'];
    public static $returnable = ['data_type','company_id','total_data','status','remaining_data'];

    public function device(){
        return $this->belongsTo('App\Model\Device','device_id','id');
    }

    public function scopeExcludeJsonData($query)
    {
        return $query->get( ['id','data_type','total_data','remaining_data','created_at'] );
    }
}

