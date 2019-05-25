<?php

namespace App\Http\Controllers;

use App\Model\LeaveType;
use Illuminate\Http\Request;
use Auth;

class LeaveTypeController extends Controller
{
    public function index(){
        $leave_types = LeaveType::where('company_id','=',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.leave-type.index')->with([
            'leave_types'   => $leave_types
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'  => 'required',
        ]);
        LeaveType::create($request->only('name'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully created region.'
        ]);
    }

    public function update(Request $request,$id){
        LeaveType::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->update($request->only('name'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully updated region.'
        ]);
    }
    public function delete($id){
        LeaveType::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
