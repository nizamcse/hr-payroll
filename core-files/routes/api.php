<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('zk/{company_id}/devices',function(Request $request,$company_id){
    $company = \App\Model\Company::where('company_id',$company_id)->first();
    $devices = \App\Model\Device::where('company_id',$company->id)->excludeTimeStamps()->get()->toArray();
    return count($devices) ? response()->json($devices) : "";
});

Route::get('zk/{company_id}/updatelogs/',function(Request $request,$company_id){
    $company = \App\Model\Company::where('company_id',$company_id)->first();
    $updatelogs = \App\Model\UpdateLog::where('company_id',$company->id ?? null)->excludeJsonData()->orderBy('created_at','desc')->get();
    return response()->json($updatelogs);
});




Route::post('zk/{companyId}/logs/update',function(Request $request,$companyId){

    ini_set('max_execution_time', 1000);
    $data = json_encode($request->all());
    try{
        $company = \App\Model\Company::where('company_id',$companyId)->first();
        $data = $request->all();
        $total = count($data);
        $device_id = $total > 0 ? $data[0]['MachineNumber'] : null;
        \App\Model\UpdateLog::create([
            'company_id'    => $company->id ?? null,
            'json_data'     => $data,
            'data_type'     => 'logs',
            'total_data'    => $total,
            'device_id'     => $device_id
        ]);
        return [
            'status'    => 200,
            'message'   => 'Successfully synced the update logs information.'
        ];
    }catch (\Exception $e){
        return [
            'status'    => 0,
            'message'   => 'Something went wrong' . $e->getMessage()
        ];
    }
});

Route::post('zk/{companyId}/employee/update',function(Request $request,$companyId){
    ini_set('max_execution_time', 1000);
    try{
        $company = \App\Model\Company::where('company_id',$companyId)->first();
        $data = $request->all();
        $total = count($data);
        $device_id = $total > 0 ? $data[0]['MachineNumber'] : null;
        \App\Model\UpdateLog::create([
            'company_id'    => $company->id ?? null,
            'json_data'     => json_encode($request->all()),
            'data_type'     => 'employees',
            'total_data'    => $total,
            'device_id'     => $device_id
        ]);
        return [
            'status'    => 200,
            'message'   => 'Successfully synced the employee information.'
        ];
    }catch (\Exception $e){
        return [
            'status'    => 0,
            'message'   => 'Something went wrong' . $e->getMessage()
        ];
    }
});


Route::get('test-api',function(){
    return json_decode(\App\Model\UpdateLog::first()->employees);
});
