<?php

namespace App\Observers;

use App\Model\Designation;

class DesignationObserver
{
    public function creating(Designation $designation){
        $gross_salary = $designation->basic + $designation->house_rent + $designation->medical + $designation->convey + $designation->food;
        $designation->gross_salary = $gross_salary;
    }
    /**
     * Handle the desination "created" event.
     *
     * @param  \App\Model\Designation  $designation
     * @return void
     */
    public function created(Designation $designation)
    {
        //
    }

    public function updating(Designation $designation){

        $gross_salary = $designation->basic + $designation->house_rent + $designation->medical + $designation->convey + $designation->food;
        $designation->gross_salary = $gross_salary;
        dd($designation);
    }

    /**
     * Handle the desination "updated" event.
     *
     * @param  \App\Model\Designation  $designation
     * @return void
     */
    public function updated(Designation $designation)
    {
        dd($designation);
    }

    /**
     * Handle the desination "deleted" event.
     *
     * @param  \App\Model\Designation  $designation
     * @return void
     */
    public function deleted(Designation $designation)
    {
        //
    }

    /**
     * Handle the desination "restored" event.
     *
     * @param  \App\Model\Designation  $designation
     * @return void
     */
    public function restored(Designation $designation)
    {
        //
    }

    /**
     * Handle the desination "force deleted" event.
     *
     * @param  \App\Model\Designation  $designation
     * @return void
     */
    public function forceDeleted(Designation $designation)
    {
        //
    }
}
