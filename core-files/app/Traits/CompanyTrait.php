<?php
/**
 * Created by PhpStorm.
 * User: fahadseraj
 * Date: 1/20/2019 AD
 * Time: 11:48 AM
 */

namespace App\Traits;
use Auth;


trait CompanyTrait
{
    public static function bootCompanyTrait()
    {
        static::creating(function ($model) {
            if(Auth::user())
                $model->company_id = Auth::user()->company_id;
        });
    }

}
