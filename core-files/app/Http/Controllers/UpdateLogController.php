<?php

namespace App\Http\Controllers;

use App\Model\UpdateLog;
use Illuminate\Http\Request;
use Auth;

class UpdateLogController extends Controller
{
    public function index(){
        $logs = \App\Model\UpdateLog::with(['device'])->select(['id','data_type','company_id','total_data','status','remaining_data','device_id'])->where('company_id',Auth::user()->company_id)->get();
        return view('admin.update-log.index')->with([
            'logs'   => $logs
        ]);
    }
    public function delete($id){
        UpdateLog::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
