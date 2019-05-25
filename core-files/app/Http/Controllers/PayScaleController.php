<?php

namespace App\Http\Controllers;

use App\Model\PayScale;
use Illuminate\Http\Request;
use Auth;

class PayScaleController extends Controller
{
    public function index(){
        $pay_scales = PayScale::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.pay-scale.index')->with([
            'pay_scales'   => $pay_scales
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'  => 'required',
        ]);
        $gross_salary = $request->food + $request->basic + $request->house_rent + $request->convey + $request->medical;
        PayScale::create([
            'house_rent'  => $request->house_rent,
            'name'  => $request->name,
            'basic'       => $request->basic,
            'medical'     => $request->medical,
            'convey'      => $request->convey,
            'food'        => $request->food,
            'att_bonus'   => $request->att_bonus,
            'gross_salary'  => $gross_salary,
            'ot_salary_per_hour'    => $request->ot_salary_per_hour
        ]);
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully created pay scale.'
        ]);
    }

    public function update(Request $request,$id){
        $gross_salary = $request->food + $request->basic + $request->house_rent + $request->convey + $request->medical;
        PayScale::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->update([
            'name'  => $request->name,
            'house_rent'  => $request->house_rent,
            'basic'       => $request->basic,
            'medical'     => $request->medical,
            'convey'      => $request->convey,
            'food'        => $request->food,
            'att_bonus'   => $request->att_bonus,
            'gross_salary'  => $gross_salary,
            'ot_salary_per_hour'    => $request->ot_salary_per_hour
        ]);
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully updated region.'
        ]);
    }
    public function delete($id){
        PayScale::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
