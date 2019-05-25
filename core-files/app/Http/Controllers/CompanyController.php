<?php

namespace App\Http\Controllers;

use App\Model\Company;
use App\User;
use Illuminate\Http\Request;
use Auth;
use File;

class CompanyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $companies = Company::allActive();
        return view('admin.company.index')->with([
            'companies' => $companies,
        ]);
    }


    public function edit($id){
        $company = Company::findOrFail($id);
        return view('admin.company.edit')->with([
            'company'   => $company
        ]);
    }

    public function store(Request $request){

        $company = Company::create([
            'name'          => $request->name,
            'email'         => $request->company_email,
            'address'       => $request->address,
            'contact_no'    => $request->contact_no,
        ]);

        if($request->file('logo')){
            $name = "logo.".$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move('images/'.str_slug($company->name,'-'),$name);
            $name = 'images/'.str_slug($company->name,'-').$name;
            $company->fill([
                'logo' => $name
            ]);
        }
        return redirect()->route('companies');
    }

    public function updateOrCreateAdmin(Request $request,$company_id){
        $user =$user = User::where('company_id',$company_id)->where('company_admin',true)->first();
        $company = Company::findOrFail($company_id);
        if($user){
            $this->validate($request,[
                'admin_name'    => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            ]);
            if($request->password){
                $this->validate($request,[
                    'password'      => ['required', 'string', 'min:6', 'confirmed'],
                ]);
                $user->update([
                    'name'          => $request->admin_name,
                    'email'         => $request->email,
                    'password'      => bcrypt($request->password),
                    'company_id'    => $company->id,
                    'company_admin' => 1
                ]);
            }else{
                $user->update([
                    'name'          => $request->admin_name,
                    'email'         => $request->email,
                    'company_id'    => $company->id,
                    'company_admin' => 1
                ]);
            }
        }else{
            $this->validate($request,[
                'admin_name'    => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'      => ['required', 'string', 'min:6', 'confirmed'],
            ]);
            User::create([
                'name'          => $request->admin_name,
                'email'         => $request->email,
                'password'      => bcrypt($request->password),
                'company_id'    => $company->id,
                'company_admin' => 1
            ]);
        }
        return redirect()->back();
    }

    public function update(Request $request,$id){
        $company = Company::findOrFail($id);
        $data = $request->all();
        $path = public_path().'/'.$company->logo;
        if($request->file('logo')){
            File::delete($path);
            $name = "logo.".$request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move('images/'.str_slug($company->name,'-'),$name);
            $name = 'images/'.str_slug($company->name,'-').'/'.$name;
            $data['logo'] = $name;
        }
        $company->update($data);
        $company->admin()->detach();
        $user = User::findOrFail($request->user_id);

        $company->users()->attach($user->id,[
            'is_admin'  => 1
        ]);
        return redirect()->route('companies');
    }

    public function delete($id){
        Company::findOrFail($id)->delete();
        return redirect()->route('companies');
    }

    public function findUser(Request $request){
        return User::whereEmail($request->email)->first();
    }
}
