<?php

namespace App\Observers;

use App\Model\BasicSetting;
use Carbon\Carbon;

class BasicSettingsObserver
{
    public function creating(BasicSetting $basicSetting){
        $in_time = Carbon::parse($basicSetting->in_time ?? 0);
        $exit_time = Carbon::parse($basicSetting->exit_time ?? 0);
        $hours = $in_time->copy()->diffInHours($exit_time);
        $minutes = $in_time->copy()->addHours($hours)->diffInMinutes($exit_time);
        $working_hour = $hours + ($minutes / 100);
        $basicSetting->minimum_working_hour = $working_hour;
    }
    /**
     * Handle the basic setting "created" event.
     *
     * @param  \App\BasicSetting  $basicSetting
     * @return void
     */
    public function created(BasicSetting $basicSetting)
    {
        //
    }

    public function updating(BasicSetting $basicSetting){
        $in_time = Carbon::parse($basicSetting->in_time ?? 0);
        $exit_time = Carbon::parse($basicSetting->exit_time ?? 0);
        $hours = $in_time->copy()->diffInHours($exit_time);
        $minutes = $in_time->copy()->addHours($hours)->diffInMinutes($exit_time);
        $working_hour = $hours + ($minutes / 100);
        $basicSetting->minimum_working_hour = $working_hour;
    }

    /**
     * Handle the basic setting "updated" event.
     *
     * @param  \App\BasicSetting  $basicSetting
     * @return void
     */
    public function updated(BasicSetting $basicSetting)
    {
        //
    }

    /**
     * Handle the basic setting "deleted" event.
     *
     * @param  \App\BasicSetting  $basicSetting
     * @return void
     */
    public function deleted(BasicSetting $basicSetting)
    {
        //
    }

    /**
     * Handle the basic setting "restored" event.
     *
     * @param  \App\BasicSetting  $basicSetting
     * @return void
     */
    public function restored(BasicSetting $basicSetting)
    {
        //
    }

    /**
     * Handle the basic setting "force deleted" event.
     *
     * @param  \App\BasicSetting  $basicSetting
     * @return void
     */
    public function forceDeleted(BasicSetting $basicSetting)
    {
        //
    }
}
