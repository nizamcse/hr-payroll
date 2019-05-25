<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name','address','contact_no','email','logo','company_id','api_access_token','slug','status'];

    public function users(){
        return $this->hasMany('App\User','company_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admin(){
        return $this->hasMany('App\User','company_id','id')->where('company_admin',true);
    }

    public function getLogoAttribute($logo){
        return asset($logo);
    }

    public static function allActive(){
        return self::whereStatus(true)->get();
    }
}
