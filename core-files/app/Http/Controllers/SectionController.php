<?php

namespace App\Http\Controllers;

use App\Model\Section;
use Illuminate\Http\Request;
use Auth;

class SectionController extends Controller
{
    public function index(){
        $sections = Section::where('company_id',Auth::user()->company_id)->orderBy('name','asc')->get();
        return view('admin.section.index')->with([
            'sections'   => $sections
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'  => 'required',
        ]);
        Section::create($request->only('name'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully created region.'
        ]);
    }

    public function update(Request $request,$id){
        Section::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->update($request->only('name'));
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully updated region.'
        ]);
    }
    public function delete($id){
        Section::where([
            'company_id'    => Auth::user()->company_id,
            'id'            => $id
        ])->delete();
        return redirect()->back()->withMessage([
            'status'    => true,
            'text'      => 'Successfully deleted region.'
        ]);
    }
}
