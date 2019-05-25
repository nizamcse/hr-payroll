<?php

namespace App\Providers;

use App\Model\Attendance;
use App\Model\BasicSetting;
use App\Model\Designation;
use App\Model\SalaryPayment;
use App\Model\Vacation;
use App\Observers\AttendanceObserver;
use App\Observers\BasicSettingsObserver;
use App\Observers\SalaryPaymentObserver;
use App\Observers\VacationObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Vacation::observe(VacationObserver::class);
        Attendance::observe(AttendanceObserver::class);
        BasicSetting::observe(BasicSettingsObserver::class);
        SalaryPayment::observe(SalaryPaymentObserver::class);
        //Designation::observe(DesignationObserver::class);
    }
}
