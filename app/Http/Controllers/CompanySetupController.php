<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Validator;
use Session;
use DB;


class CompanySetupController extends Controller
{
    public function companySetup()
    {
      $companys = Company::all();
        if(Auth::check()){
        return view ('company-setup',[
            'companys' => $companys
         ]);
        }
        return redirect("/")->withSuccess('Opps! You do not have access');
    } 

    public function cmpySet(Request $request)
   {
    //$data = DB::table("companys_tbl")->count();
    //print_r($data);

     // print_r($_POST); die;
       $validator = Validator::make($request->all(),[
        'cmpyName'=> 'required',
        'cmpyNo'=> 'required',
        'gstNum'=> 'required',
        'cmpyAddress'=> 'required',
        'bankName'=> 'required',
        'bankAcc'=> 'required',
        'ifscCode'=> 'required',
        'billerName'=> 'required',
        'payCall'=> 'required',
        'society' => 'required',
        'sector' => 'required',
        'city' => 'required'

      ]);
      //print_r($validator); die;

      if($validator->passes()){

        $company = new Company();
        $company->cmpyName=$request->cmpyName;
        $company->cmpyNo=$request->cmpyNo;
        $company->gstNum=$request->gstNum;
        $company->cmpyAddress=$request->cmpyAddress;
        $company->bankName=$request->bankName;
        $company->bankAcc=$request->bankAcc;
        $company->ifscCode=$request->ifscCode;
        $company->billerName=$request->billerName;
        $company->payCall=$request->payCall;
        $company->society=$request->society;
        $company->sector=$request->sector;
        $company->city=$request->city;


        $exists = DB::table('companys_tbl')->count();             //insert only single row

        if($exists > 0){
          $response['success'] = false;
          $response['messages'] = 'Data already exists';
          return response()->json(['success' => $response]);
       }else{

        $company->save();
        $response['success'] = true;
        $response['messages'] = 'Company Setup Done';
        return response()->json(['success' => $response]);
      }
    }
     
}

public function deleteData($company_id){

  $company = Company::find($company_id);
  //Session::flash('delete', 'deleted');
  $company->delete();
  
  return redirect()->back();
}   

    }        
       
      