<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CustomersImport;
use App\Models\Customer;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;
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
    public function importData(Request $request)
    {
       //echo "<pre>";print_r($_FILES);die;
     try {      
           $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);     //check extension
           $csvFile = fopen($_FILES['uploadFile']['tmp_name'], 'r');           
           fgetcsv($csvFile);
           //echo '<pre>'; print_r($csvFile); die;

           while(($csvData = fgetcsv($csvFile)) !== FALSE){
           $csvData = array_map("utf8_encode", $csvData);
           //echo '<pre>'; print_r($csvData); die;

           $formonth = $_POST['formonth'];
           $foryear = $_POST['foryear'];
           $flat_no = $csvData[1];
          
            $exists = Customer::where('flat_no', '=', $csvData[1])
           ->where('formonth', '=',  $formonth)
           ->where('foryear', '=', $foryear)->exists();
           //echo '<pre>'; print_r($exists); die;

           if($exists){

            Session::flash('error', 'Data Already Exists');
            return redirect()->back();

           }
           else{

            $data = Excel::import(new CustomersImport, request()->file('uploadFile'));
            Session::flash('dataimported', 'Data has been imported successfully');
            return redirect()->back();

            }  
        }  
         }catch (\Exception $e) {
           $bug = $e->getMessage();
           $response['success'] = false;
           $response['messages'] = $bug;
           return Response::json($response);
       }
   }
   public function uploadCSV(Request $request)

   {

       echo "<pre>";print_r($_FILES);die;  
    try {      
        $extension = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);     //check extension
        $csvFile = fopen($_FILES['uploadFile']['tmp_name'], 'r');           
        fgetcsv($csvFile);
       // echo '<pre>'; print_r($csvFile); die;

        while(($csvData = fgetcsv($csvFile)) !== FALSE){
        $csvData = array_map("utf8_encode", $csvData);
      //echo '<pre>'; print_r($csvData); die;    
        $formonth = $_POST['formonth'];
        $foryear = $_POST['foryear'];
        $flat_no = $csvData[1];
       
         $exists = Customer::where('flat_no', '=', $csvData[1])
        ->where('formonth', '=',  $formonth)
        ->where('foryear', '=', $foryear)->exists();
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
     }  
      }catch (\Exception $e) {
        $bug = $e->getMessage();
        $response['success'] = false;
        $response['messages'] = $bug;
        return Response::json($response);
     }
   }
}
