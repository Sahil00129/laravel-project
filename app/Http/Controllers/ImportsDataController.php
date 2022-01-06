<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CustomersImport;
use App\Models\Customer;
use App\Models\Reading;
use App\Models\Master;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;
use Illuminate\Support\Facades\Input;
use Session;
use Response;
use DB;


class ImportsDataController extends Controller
{
    public function index()
    {
        return view ('importsData');
    }

 /**********************************************Imports Data*********************************************/
   
   /////////////////////////////////////////////////////////////////////////////////////////////////
   //////////////////////////////////////ajax import//////////////////////////////////////////////
   //////////////////////////////////////////////////////////////////////////////////////////////
   
   
 

///////////////////////////////////////////////////////////////////////////////////

public function uploadMasters(Request $request)

{
  if($_POST['itype'] == 1){
   // echo '<pre>'; print_r($_POST); die
    try {   

            $data = Excel::import(new CustomersImport, request()->file('uploadFile'));
            $response['success'] = true;
            $response['messages'] = 'Succesfully imported';
            return response()->json(['success' => $response]);
          
        }catch (\Exception $e) {
          $response['success'] = false;
          $response['messages'] = 'something wrong';
          return response()->json(['success' => $response]);
      }
     

    

   }elseif($_POST['itype'] == 2){
        //echo '<pre>'; print_r($_FILES); die;
        try {      
                  
         $monthyear = $_POST['monthyear'];

        
             $exists = Reading::where
               ('monthyear', '=',  $monthyear)
            ->exists();
            //echo '<pre>'; print_r($exists); die;
           
            if($exists){
 
             $response['success'] = false;
            $response['messages'] = 'Data already exists';
            return response()->json(['success' => $response]);
 
            }
            else{
 
            

             $data = Excel::import(new CustomersImport, request()->file('uploadFile'));
             $response['success'] = true;
             $response['messages'] = 'Succesfully imported';
             return response()->json(['success' => $response]);
 
           
         }  
          }catch (\Exception $e) {
            //$bug = $e->getMessage();
            $response['success'] = false;
            $response['messages'] = 'import field doesnot match';
            return response()->json(['success' => $response]);
        }

   }

}

public function uploadCSV(Request $request)

   {
      
     if($_POST['itype'] == 3){
     
        try {      
                  
         $monthyear = $_POST['monthyear'];

         $last = (explode("-",$monthyear));
         $c = $last[1] - 1;
         $y =  str_pad($c, 2, "0", STR_PAD_LEFT);
         $i = array($last[0], $y);
         $final =  implode("-",$i);
         //echo'<pre>'; print_r($final); die;
             $exists = Master::where
               ('monthyear', '=',  $monthyear)
            ->exists();
            //echo '<pre>'; print_r($exists); die;
           
            if($exists){
 
             $response['success'] = false;
             Session::flash('error', 'Data Already Exists');
            return response()->json(['success' => $response]);
 
            }
            else{
 
             $qry = Master::select('flat_no', 'cur_rd','cur_rd_dt')->where('monthyear', $final)->get();
             $reslt = $qry->toArray();
             // echo'<pre>'; print_r($reslt); die;
             $arr1 = array();
             foreach($reslt as $value){
             //echo'<pre>'; print_r($reslt); die;
             $slct = DB::table('readings')->where('flat_no', $value['flat_no'])->insert(['flat_no' => $value['flat_no'],'pr_rd' => $value['cur_rd'], 'pr_rd_dt'=>$value['cur_rd_dt'],'monthyear' => $monthyear]);
               //echo'<pre>'; print_r($slct); die;
          }

             $data = Excel::import(new CustomersImport, request()->file('uploadFile'));
             $response['success'] = true;
             Session::flash('dataimported', 'Data has been imported successfully');
             return response()->json(['success' => $response]);
 
           
         }  
          }catch (\Exception $e) {
            //$bug = $e->getMessage();
            $response['success'] = false;
            Session::flash('wrong', 'Data has been imported successfully');
            return response()->json(['success' => $response]);
        }
      
      }
      }



}
