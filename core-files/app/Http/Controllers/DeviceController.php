<?php

namespace App\Http\Controllers;

use App\Model\Device;
use Illuminate\Http\Request;
use Auth;

class DeviceController extends Controller
{
    public function index(){
        $devices = Device::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.device.index')->with([
            'devices'   => $devices
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'  => 'required',
        ]);
        Device::create($request->only('name','ip_address','port','device_no'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully created device.'
        ]);
    }

    public function update(Request $request,$id){
        Device::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->update($request->only('name','ip_address','port','device_no'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully updated region.'
        ]);
    }
    public function delete($id){
        Device::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
