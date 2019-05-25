<?php

namespace App\Http\Controllers;

use App\Model\Designation;
use Illuminate\Http\Request;
use Auth;

class DesignationController extends Controller
{
    public function index(){
        $designations = Designation::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.designation.index')->with([
            'designations'   => $designations
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'  => 'required',
        ]);
        $gross_salary = $request->food + $request->basic + $request->house_rent + $request->convey + $request->medical;
        Designation::create([
            'house_rent'  => $request->house_rent,
            'name'  => $request->name,
            'basic'       => $request->basic,
            'medical'     => $request->medical,
            'convey'      => $request->convey,
            'food'        => $request->food,
            'gross_salary'  => $gross_salary
        ]);
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully created region.'
        ]);
    }

    public function update(Request $request,$id){
        $gross_salary = $request->food + $request->basic + $request->house_rent + $request->convey + $request->medical;
        Designation::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->update([
            'name'  => $request->name,
            'house_rent'  => $request->house_rent,
            'basic'       => $request->basic,
            'medical'     => $request->medical,
            'convey'      => $request->convey,
            'food'        => $request->food,
            'gross_salary'  => $gross_salary
        ]);
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully updated region.'
        ]);
    }
    public function delete($id){
        Designation::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
