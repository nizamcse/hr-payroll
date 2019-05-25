<?php

namespace App\Http\Controllers;

use App\Model\PaymentMethod;
use Illuminate\Http\Request;
use Auth;

class PaymentMethodController extends Controller
{
    public function index(){
        $payment_methods = PaymentMethod::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.payment-method.index')->with([
            'payment_methods'   => $payment_methods
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'  => 'required',
        ]);
        PaymentMethod::create($request->only('name'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully created region.'
        ]);
    }

    public function update(Request $request,$id){
        PaymentMethod::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->update($request->only('name'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully updated region.'
        ]);
    }
    public function delete($id){
        PaymentMethod::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
