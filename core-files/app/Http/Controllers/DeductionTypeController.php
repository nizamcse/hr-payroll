<?php

namespace App\Http\Controllers;

use App\Model\DeductionType;
use Illuminate\Http\Request;
use Auth;

class DeductionTypeController extends Controller
{
    public function index(){
        $deduction_types = DeductionType::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.deduction-type.index')->with([
            'deduction_types'   => $deduction_types
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'  => 'required',
        ]);
        DeductionType::create($request->only('name'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully created region.'
        ]);
    }

    public function update(Request $request,$id){
        DeductionType::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->update($request->only('name'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully updated region.'
        ]);
    }
    public function delete($id){
        DeductionType::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
