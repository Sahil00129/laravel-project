<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Master;
use App\Models\Reading;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use LynX39\LaraPdfMerger\Facades\PdfMerger;
use PDF;
use DB;
use ZipArchive;
use File;
use Session;

class MonthlygetDataController extends Controller
{
    public function index()
    {
      if(Auth::check()){
        return view ('monthlyBased');
      }
      return redirect("/")->withSuccess('Opps! You do not have access');
    }

 /***********************************************Fetch Data***********************************************/   
    public function fetchData()     
      {
        $customers = DB::select('select * from customers');
        if(Auth::check()){
        return view('customers',['customers'=>$customers]);
      }
      return redirect("/")->withSuccess('Opps! You do not have access');
        //echo '<pre>'; print_r($customers); die;      
      }
 /************************************************************************************************************/
 /********************************************Monthly Based Data**********************************************/
 /************************************************************************************************************/
 public function getData()
 {

     $monthyear = $_POST['monthyear'];  

     $master = DB::table('customers')
     ->join('readings', 'customers.flat_no','=','readings.flat_no')
     ->join('masters_tbl_', 'customers.flat_no','=','masters_tbl_.flat_no')
     ->where('masters_tbl_.monthyear',$monthyear)->where('readings.monthyear',$monthyear)
     ->get(); 

      $sim_reading = $master->toArray();
      $array = json_decode(json_encode($sim_reading), true);
     // echo'<pre>'; print_r($array); die;

     foreach($array as $sim){
      // echo'<pre>'; print_r($sim); die;
      $meterReading = $sim['cur_rd'] - $sim['pr_rd'];
      $unitConsumed =  $meterReading *  $sim['conv_fac']; 
      $amount =  $unitConsumed * $sim['gas_rt'];   
      $balance = $amount + $sim['main_char'] + $sim['lat_pay_char'] ;
      $npa = $balance - $sim['amt_last_p'];

      
        $stack = array('cons_unt' => $meterReading, 'unt_cons' => $unitConsumed, 'amt'=> $amount, 'bal' => $balance, 'npa'=> $npa);
    
        $d = array_merge($sim, $stack);
        //echo'<pre>'; print_r($d); die;
        $items[] =  $d;
        //echo'<pre>'; print_r($d); die;
     }
     if(!empty($items)){
     return response()->json(['response' =>$items]);        
     }else{
      $response['success'] = false;
      $response['messages'] = 'Data already exists';
      return response()->json(['success' => $response]);
     }
 }
 /*************************************************************************************************************/
 /**********************************************GET all invoice PDF*******************************************/
 /************************************************************************************************************/
 public function getPDF()
  { 

              set_time_limit(30000);
               // $customers = new Customer;
              $monthyear = $_POST['monthyear'];     
              $companys = Company::all();
              $companys1 = $companys->toArray();
              foreach($companys1 as $company1){
             //echo'<pre>'; print_r($company1); die;
              new Customer ([
             'cmpyName' =>$company1['cmpyName'],
             'cmpyNo' =>$company1['cmpyNo'],
             'gstNum' =>$company1['gstNum'],
             'cmpyAddress' =>$company1['cmpyAddress'],
             'bankAcc' =>$company1['bankAcc'],
             'ifscCode' =>$company1['ifscCode'],
             'billerName' =>$company1['billerName'],
             'payCall' =>$company1['payCall'],
             'society' =>$company1['society'],
             'sector' =>$company1['sector'],
             'city' =>$company1['city'],
             ]);
            // echo'<pre>'; print_r($company1['cmpyName']); die;
             } 
              $flats = Master::select('flat_no')->distinct()->get();
              //$flats = $qry->toArray();
             
              $arr1 = array();
              foreach($flats as $flat){     
               $reading = Reading::select('flat_no','pr_rd','pr_rd_dt')->where('monthyear', $monthyear)->where('flat_no', $flat->flat_no)->get();
               $sim_reading = $reading->toArray();
              //echo'<pre>'; print_r($sim_reading ); die;
              $Masters = Master::select('flat_no','cur_rd','cur_rd_dt','lat_pay_char','amt_last_p','cred_bal','inv_n','inv_d')->where('monthyear', $monthyear)->where('flat_no', $flat->flat_no)->get();
              $sim_master = $Masters->toArray();
            
              //echo'<pre>'; print_r($sim_master); die;
              $customers = Customer::select('flat_no','conv_fac','gas_rt','main_char')->where('flat_no', $flat->flat_no)->get();
              $sim_customers = $customers->toArray();
               $d = array_merge($sim_master, $sim_customers, $sim_reading);
               $allinone = call_user_func_array("array_merge", $d);
               if(empty($sim_master)){
                Session::flash('error', 'No data for this month');
                return redirect()->back();
                 }else{

              // echo '<pre>'; print_r($allinone); die;
              $meterReading = $allinone['cur_rd'] - $allinone['pr_rd'];
              $unitConsumed =  $meterReading *  $allinone['conv_fac']; 
              $amount =  $unitConsumed * $allinone['gas_rt'];   
              $balance = $amount + $allinone['main_char'] + $allinone['lat_pay_char'] ;
              $npa = $balance - $allinone['amt_last_p']; 
    
             //$code = url('/code.jpg');
            // $pay = url('/pay.jpg');
            //$d = date('d-m-Y', strtotime($merge['inv_d']));
            // echo '<pre>'; print_r($merge); die;
            //print_r($merge['flat_no']); die;
      
           $html = '<html>
           <body style="font-size: 12px;  margin:0px; padding:0px;">
           <table width="100%" border= "0" cellspacing="0" cellpadding="0">
           <tr>
             <td colspan="2" style="width:70%; border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;"><h2 style="margin-top: 3px; padding: 6px;"><u>'.$company1['cmpyName'].'</u></h2>
           <p style="margin-bottom: 3px; margin-top: -15px; padding: 6px;">9 Square Building, Sohana Landran Road, Sector 77, Mohali<br>
               Phone No. +91 '.$company1['cmpyNo'].'<br>
               GST No. '.$company1['gstNum'].'</p></td>
                  <td style="width:30%; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"> &nbsp; &nbsp;&nbsp;&nbsp;<img src="" alt="ic"width="100" height="60"> <img src="" alt="" width="80" height="70" style="margin-top: 10px;">
                  </td>
          </tr>
          <tr>
           <td style="width:30%; border-left: 1px solid black;  border-bottom: 1px solid black;"><p style="margin-top: 1px; margin-bottom: 2px; padding:3px;">Society:	Park View Residency<br>
           &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Plot No.1, Sector 66<br>
           &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;Mohali</p></td>
           <td style="width:35%; border-bottom: 1px solid black; "><table><tr><td><label style=" display: inline-block; width: 90px;" for="username">Flat No.</label>
           <span>'.$allinone['flat_no'].'</span>
           
       </td> </tr>  <tr><td>&nbsp;</td></tr><tr><td></td></tr> </table>
       </td>
 
              <td style="width:30%; border-bottom: 1px solid black; border-right: 1px solid black; ">
                 <table>
                  <tr>
                      <td><label style=" display: inline-block; width: 80px;" for="username">Invoice No. :</label>
                <span>'.$allinone['inv_n'].'</span></td>
                 </tr>
                 <tr>
                     <td>
                 <label style=" display: inline-block; width: 80px;" for="username">Invoice Date :</label>
                     <span></span>
                 </tr></td> </table></td>
             </tr>
              <tr>
                <td style="width:30%; border-left: 1px solid black;"><table>
                  <tr>
                      <td><label style="text-align:left; " for="username">Customer name:</label>
                        </td>
                  </tr>
                  <tr>
                     <td><label style="text-align:left;" for="username">Place:</label>
                        </td>
                 </tr>
                 <tr>
                     <td><label style="text-align:left;" for="username">Cust. Email:</label>
                        </td>
                 </tr>
                 <tr>
                     <td><label style="text-align:left;" for="username">Secondary No:</label>
                     <br> <br>
                      </td>
                 </tr>
 
              </table></td>
              <td style="width:40%;">
                 <table>
                     <tr>
                         <td><label style="text-align: left; display: inline-block; width: 120px;" for="username">Conversion Factor:</label>
                           <span>'.$allinone['conv_fac'].'</span></td>
                     </tr>
                     <tr>
                        <td><label style="text-align:left; display: inline-block; width: 120px;" for="username">Meter Reading:</label>
                          <span>'.$meterReading.'</span></td>
                    </tr>
                    <tr>
                        <td><label style="text-align:left; display: inline-block; width: 120px;" for="username">Units Consumed:</label>
                          <span>'.$unitConsumed.'</span></td>
                    </tr>
                    <tr>
                        <td><label style="text-align:left;  display: inline-block; width: 120px;" for="username">Rate Per Kg:</label>
                           <span>'.$allinone['gas_rt'].'</span></td>
                    </tr> </table> </td>
                   
                    <td style="width:30%; border-right: 1px solid black; text-align: right;">
                     <table>
                         <tr>
                             <td><label style="text-align:left;  display: inline-block; width: 160px;" for="username">Usage Amount:</label>
                                <span>'.$amount.'</span></td>
                         </tr>
                         <tr>
                            <td><label style="text-align:left; display: inline-block; width: 160px;" for="username">Maintenance Charges:</label>
                              <span style="text-align: right;">'.$allinone['main_char'].'</span></td>
                        </tr>
                        <tr>
                            <td><label style="text-align:left; display: inline-block; width: 160px;" for="username">Late Payment Charges:</label>
                              <span>'.$allinone['lat_pay_char'].'</span></td>
                        </tr>
                        <tr>
                            <td><label style="text-align:left; display: inline-block; width: 160px;" for="username">Cheque Bounce Charges:</label>
                              <span></span></td>
                        </tr> </table>  </td>
                      </tr>
 
                     <tr>
                             <td colspan ="2" style="border-left: 1px solid black; border-bottom: 1px solid black; text-align: left;"><table>
                                 <tr>
                                     <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Previous Reading:</label>
                                        <span>'.$allinone['pr_rd'].'</span></td>
                                 </tr>
                                 <tr>
                                    <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Previous Reading Date:</label>
                                    <span>'.$allinone['pr_rd_dt'].'</span> </td>
                                </tr>
                                <tr>
                                    <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Current Reading:</label>
                                    <span>'.$allinone['cur_rd'].'</span></td>
                                </tr>
                                <tr>
                                    <td><label style="text-align:left; display: inline-block; width: 110px;" for="username">Current Reading Date</label>
                                      <span>'.$allinone['cur_rd_dt'].'</span></td>
                                </tr> </table> </td>
 
                                
                                <td style=" border-right: 1px solid black; border-bottom: 1px solid black; text-align: right;">
                                 <table>
                                     <tr>
                                         <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Last Payment:</label>
                                            <span>'.$allinone['lat_pay_char'].'</span></td>
                                     </tr>
                                     <tr>
                                        <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Total Invoice Amount:</label>
                                          <span>'.$balance.'</span>
                                         </td>
                                    </tr>
                                    <tr>
                                        <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Credit Balance:</label>
                                        <span>'.$allinone['cred_bal'].'</span>
                                           </td>
                                    </tr>
                                     </table></td>
                         </tr>
           
                     <tr>
                         <td colspan="3" style="text-align:right; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">
                             <label style="text-align:left;  display: inline-block; width: 200px; margin-top: 0px; margin-bottom: 12px;" for="username"><b>Net Payable Amount:<b></label>
                             <span>'.$npa.'</span>
                         </td>
                     </tr>
              
                     <tr>
                         <td colspan="2" style="border-left:1px solid black; border-bottom: 1px  solid black;"><table>
                            
                             <p style="margin-left:25px">&nbsp;&nbsp;&nbsp; &nbsp;<u><b>NEFT / IMPS:</b></u> Bank Account No.: '.$company1['bankAcc'].'<br>
                             &nbsp;&nbsp;&nbsp; &nbsp; Bank : ICICI Bank Limited | IFSC Code : '.$company1['ifscCode'].'<br>
                             &nbsp;&nbsp;&nbsp; &nbsp;  <b><u>Cheques<u></b> in favour of '.$company1['cmpyName'].'<br>
                                 </p>
                                 <ul>
                                 <li>Late Payment Charges @ 2% per month</li>
                                 <li>For Bill Payment call Mr. '.$company1['billerName'].' | Mob: +91 '.$company1['payCall'].'</li>
                                 <li>GST Inclusive of 5%</li>
                             </ul>
 
                         </table></td>
                         <td style=" border-right: 1px solid black; border-bottom: 1px solid black;">
                             <div class="box" style=" box-sizing: border-box;  margin-left: 1px; border: 1px solid black; width: 200px; height: 90px;">
                                 <h4 style=" margin-top: 1px; margin-bottom: 45px; margin-left: 10px; text-align:right;">For IQBAL HP GAS SERVICE</h4>
                                 <p style="text-align: right;">Authorized Signatory</p>
                               </div>
                         </td>
                     </tr> 
             </table> 
 
 </body>
 </html>
        ';       
           $pdf = \App::make('dompdf.wrapper');
           $pdf->loadHTML($html);
           $pdf->setPaper('a5', 'landscape');
           $pdf->save(public_path().'/pdf/customer_'.$allinone['flat_no'].'.pdf')->stream('customer_'.$allinone['flat_no'].'.pdf');
           $pdf_name[] = 'customer_'.$allinone['flat_no'].'.pdf';
           // echo '<pre>'; print_r ($pdf); die;
                 }
              }

           
           $pdfMerger = PDFMerger::init(); 
           foreach($pdf_name as $pdf){
           $pdfMerger->addPDF(public_path().'/pdf/'.$pdf);
           }
           $pdfMerger->merge();
           $pdfMerger->save("All Customers.pdf", "download");
           $file = new Filesystem;
           $file->cleanDirectory('pdf'); 
                  
          
    }      
 /*   $zip = new ZipArchive();
    $filename = 'newzip.zip'; 
    if( $zip->open(($filename), ZipArchive::CREATE) ===TRUE);
 {
   $files = File::files(public_path('pdf'));
   foreach($files as $dpdf){
   // echo'<pre>'; print_r($pdf_name ); die;
     $relativeNameInZipFile = basename($dpdf);
     $zip->addFile($dpdf, $relativeNameInZipFile);
 }
   $zip->close();
  }
  return response()->download($filename);  
 }
  } */
/***********************************************Single Invoice PDF*****************************************/
  
  public function singlePDF()
  { 
        $customers = DB::table('customers')->select ('flat_no')->distinct()->get();
        return view('single-Pdf',  ['customers' => $customers]);
  }

    public function invoicePDF()
     {
         //echo'<pre>'; print_r($_POST); die;
        
         $monthyear = $_POST['monthyear'];
         $flatno = $_POST['flat_no'];
         

         $companys = Company::all();
         $companys1 = $companys->toArray();
         foreach($companys1 as $company1){
        //echo'<pre>'; print_r($company1); die;
         new Customer ([
        'cmpyName' =>$company1['cmpyName'],
        'cmpyNo' =>$company1['cmpyNo'],
        'gstNum' =>$company1['gstNum'],
        'cmpyAddress' =>$company1['cmpyAddress'],
        'bankAcc' =>$company1['bankAcc'],
        'ifscCode' =>$company1['ifscCode'],
        'billerName' =>$company1['billerName'],
        'payCall' =>$company1['payCall'],
        'society' =>$company1['society'],
        'sector' =>$company1['sector'],
       'city' =>$company1['city'],
        ]);
       // echo'<pre>'; print_r($company1['cmpyName']); die;
        } 


              $reading = Reading::select('flat_no','pr_rd','pr_rd_dt')->where('monthyear', $monthyear)->where('flat_no', $flatno)->get();
               $sim_reading = $reading->toArray();
              //echo'<pre>'; print_r($sim_reading ); die;
              $Masters = Master::select('flat_no','cur_rd','cur_rd_dt','lat_pay_char','amt_last_p','cred_bal','inv_n','inv_d')->where('monthyear', $monthyear)->where('flat_no', $flatno)->get();
              $sim_master = $Masters->toArray();
              //echo'<pre>'; print_r($sim_master); die;
              $customers = Customer::select('flat_no','conv_fac','gas_rt','main_char')->where('flat_no', $flatno)->get();
              $sim_customers = $customers->toArray();
              $d = array_merge($sim_master, $sim_customers, $sim_reading);         //array merge   
              
               $allinone = call_user_func_array("array_merge", $d);

               if(empty($sim_master)){
                Session::flash('error', 'No data for this month');
                return redirect()->back();
                 }else{
         // echo'<pre>';print_r($allinone); die;
         
         $meterReading = $allinone['cur_rd'] - $allinone['pr_rd'];
         $unitConsumed =  $meterReading *  $allinone['conv_fac']; 
         $amount =  $unitConsumed * $allinone['gas_rt'];   
         $balance = $amount + $allinone['main_char'] + $allinone['lat_pay_char'] ;
         $npa = $balance - $allinone['amt_last_p']; 
   
       // $code = url('/code.jpg');
        //$pay = url('/pay.jpg');
        // $d =  date('d-m-Y', strtotime($merge['inv_d']));
        //print_r($c); die;
          $html ='<html>
          <body style="font-size: 12px;  margin:0px; padding:0px;">
          <table width="100%" border= "0" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2" style="width:70%; border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;"><h2 style="margin-top: 3px; padding: 4px;"><u>'.$company1['cmpyName'].'</u></h2>
          <p style="margin-bottom: 3px; margin-top: -15px; padding: 4px;"><span>'.$company1['cmpyAddress'].'</span><br>
              Phone No. +91 '.$company1['cmpyNo'].'<br>
              GST No. '.$company1['gstNum'].'</p></td>
                 <td style="width:30%; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"> &nbsp; &nbsp;&nbsp;&nbsp;<img src="" alt="ic"width="100" height="60"> <img src="" alt="" width="80" height="70" style="margin-top: 10px;">
                 </td>
         </tr>
         <tr>
          <td style="width:30%; border-left: 1px solid black;  border-bottom: 1px solid black;"><p style="margin-top: 1px; margin-bottom: 2px; padding:3px;">Society:	'.$company1['society'].'<br>
          &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;'.$company1['sector'].'<br>
          &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;'.$company1['city'].'</p></td>
          <td style="width:35%; border-bottom: 1px solid black; "><table><tr><td><label style=" display: inline-block; width: 90px;" for="username">Flat No.</label>
          <span>'.$allinone['flat_no'].'</span>
          
      </td> </tr>  <tr><td>&nbsp;</td></tr><tr><td></td></tr> </table>
      </td>

             <td style="width:30%; border-bottom: 1px solid black; border-right: 1px solid black; ">
                <table>
                 <tr>
                     <td><label style=" display: inline-block; width: 80px;" for="username">Invoice No. :</label>
               <span>'.$allinone['inv_n'].'</span></td>
                </tr>
                <tr>
                    <td>
                <label style=" display: inline-block; width: 80px;" for="username">Invoice Date :</label>
                    <span></span>
                </tr></td> </table></td>
            </tr>
             <tr>
               <td style="width:30%; border-left: 1px solid black;"><table>
                 <tr>
                     <td><label style="text-align:left; " for="username">Customer name:</label>
                       </td>
                 </tr>
                 <tr>
                    <td><label style="text-align:left;" for="username">Place:</label>
                       </td>
                </tr>
                <tr>
                    <td><label style="text-align:left;" for="username">Cust. Email:</label>
                       </td>
                </tr>
                <tr>
                    <td><label style="text-align:left;" for="username">Secondary No:</label>
                    <br> <br>
                     </td>
                </tr>

             </table></td>
             <td style="width:40%;">
                <table>
                    <tr>
                        <td><label style="text-align: left; display: inline-block; width: 120px;" for="username">Conversion Factor:</label>
                          <span>'.$allinone['conv_fac'].'</span></td>
                    </tr>
                    <tr>
                       <td><label style="text-align:left; display: inline-block; width: 120px;" for="username">Meter Reading:</label>
                         <span>'.$meterReading.'</span></td>
                   </tr>
                   <tr>
                       <td><label style="text-align:left; display: inline-block; width: 120px;" for="username">Units Consumed:</label>
                         <span>'.$unitConsumed.'</span></td>
                   </tr>
                   <tr>
                       <td><label style="text-align:left;  display: inline-block; width: 120px;" for="username">Rate Per Kg:</label>
                          <span>'.$allinone['gas_rt'].'</span></td>
                   </tr> </table> </td>
                  
                   <td style="width:30%; border-right: 1px solid black; text-align: right;">
                    <table>
                        <tr>
                            <td><label style="text-align:left;  display: inline-block; width: 160px;" for="username">Usage Amount:</label>
                               <span>'.$amount.'</span></td>
                        </tr>
                        <tr>
                           <td><label style="text-align:left; display: inline-block; width: 160px;" for="username">Maintenance Charges:</label>
                             <span style="text-align: right;">'.$allinone['main_char'].'</span></td>
                       </tr>
                       <tr>
                           <td><label style="text-align:left; display: inline-block; width: 160px;" for="username">Late Payment Charges:</label>
                             <span>'.$allinone['lat_pay_char'].'</span></td>
                       </tr>
                       <tr>
                           <td><label style="text-align:left; display: inline-block; width: 160px;" for="username">Cheque Bounce Charges:</label>
                             <span></span></td>
                       </tr> </table>  </td>
                     </tr>

                    <tr>
                            <td colspan ="2" style="border-left: 1px solid black; border-bottom: 1px solid black; text-align: left;"><table>
                                <tr>
                                    <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Previous Reading:</label>
                                       <span>'.$allinone['pr_rd'].'</span></td>
                                </tr>
                                <tr>
                                   <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Previous Reading Date:</label>
                                   <span>'.$allinone['pr_rd_dt'].'</span> </td>
                               </tr>
                               <tr>
                                   <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Current Reading:</label>
                                   <span>'.$allinone['cur_rd'].'</span></td>
                               </tr>
                               <tr>
                                   <td><label style="text-align:left; display: inline-block; width: 110px;" for="username">Current Reading Date</label>
                                     <span>'.$allinone['cur_rd_dt'].'</span></td>
                               </tr> </table> </td>

                               
                               <td style=" border-right: 1px solid black; border-bottom: 1px solid black; text-align: right;">
                                <table>
                                    <tr>
                                        <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Last Payment:</label>
                                           <span>'.$allinone['lat_pay_char'].'</span></td>
                                    </tr>
                                    <tr>
                                       <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Total Invoice Amount:</label>
                                         <span>'.$balance.'</span>
                                        </td>
                                   </tr>
                                   <tr>
                                       <td><label style="text-align:left; display: inline-block; width: 150px;" for="username">Credit Balance:</label>
                                       <span>'.$allinone['cred_bal'].'</span>
                                          </td>
                                   </tr>
                                    </table></td>
                        </tr>
          
                    <tr>
                        <td colspan="3" style="text-align:right; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">
                            <label style="text-align:left;  display: inline-block; width: 200px; margin-top: 0px; margin-bottom: 12px;" for="username"><b>Net Payable Amount:<b></label>
                            <span>'.$npa.'</span>
                        </td>
                    </tr>
             
                    <tr>
                        <td colspan="2" style="border-left:1px solid black; border-bottom: 1px  solid black;"><table>
                           
                            <p style="margin-left:25px">&nbsp;&nbsp;&nbsp; &nbsp;<u><b>NEFT / IMPS:</b></u> Bank Account No.: '.$company1['bankAcc'].'<br>
                            &nbsp;&nbsp;&nbsp; &nbsp; Bank : ICICI Bank Limited | IFSC Code : '.$company1['ifscCode'].'<br>
                            &nbsp;&nbsp;&nbsp; &nbsp;  <b><u>Cheques<u></b> in favour of '.$company1['cmpyName'].'<br>
                                </p>
                                <ul>
                                <li>Late Payment Charges @ 2% per month</li>
                                <li>For Bill Payment call Mr. '.$company1['billerName'].' | Mob: +91 '.$company1['payCall'].'</li>
                                <li>GST Inclusive of 5%</li>
                            </ul>

                        </table></td>
                        <td style=" border-right: 1px solid black; border-bottom: 1px solid black;">
                            <div class="box" style=" box-sizing: border-box;  margin-left: 1px; border: 1px solid black; width: 200px; height: 90px;">
                                <h4 style=" margin-top: 1px; margin-bottom: 45px; margin-left: 10px; text-align:right;">For IQBAL HP GAS SERVICE</h4>
                                <p style="text-align: right;">Authorized Signatory</p>
                              </div>
                        </td>
                    </tr> 
            </table> 

</body>
</html>
       ';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($html);
            $pdf->setPaper('a5', 'landscape'); 
            return $pdf->download('Flat no_'.$allinone['flat_no'].'.pdf');
           
          //  $response['success'] = true;
          //  $response['messages'] = 'file downloaded';
          //  return response()->json(['success' => $response]);
           }
    }   
  
  }   


