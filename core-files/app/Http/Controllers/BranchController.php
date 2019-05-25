<?php

namespace App\Http\Controllers;

use App\Model\Branch;
use Illuminate\Http\Request;
use Auth;

class BranchController extends Controller
{
    public function index(){
        $branches = Branch::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.branch.index')->with([
            'branches'   => $branches
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'  => 'required',
        ]);
        Branch::create($request->only('name','address'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully created region.'
        ]);
    }

    public function update(Request $request,$id){
        Branch::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->update($request->only('name','address'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully updated region.'
        ]);
    }
    public function delete($id){
        Branch::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
