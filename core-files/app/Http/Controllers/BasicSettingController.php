<?php

namespace App\Http\Controllers;

use App\Model\BasicSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class BasicSettingController extends Controller
{
    public function index(){
        $basic_settings = BasicSetting::where('company_id',Auth::user()->company_id)->first();
        //return $basic_settings;
        return view('admin.basic-settings.index')->with([
            'basic_settings'    => $basic_settings
        ]);
    }

    public function store(Request $request){
        //return $request->all();
        if(!Auth::user()->company_id)
            return redirect()->back();

        $basic_settings = BasicSetting::where('company_id',Auth::user()->company_id)->first();
        $in_time = Carbon::parse($request->in_time ?? 0);
        $exit_time = Carbon::parse($request->exit_time ?? 0);
        if(!$basic_settings){
            $basic_settings = BasicSetting::create([
                'weekends'  => $request->weekends,
                'in_time'   => $in_time,
                'exit_time' => $exit_time
            ]);
        }else{
            $basic_settings->update([
                'weekends'  => $request->weekends,
                'in_time'   => $in_time,
                'exit_time' => $exit_time
            ]);
        }

        return redirect()->back()->with([
            'basic_settings'    => $basic_settings
        ]);
    }
}