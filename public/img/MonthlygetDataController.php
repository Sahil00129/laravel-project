<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
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
        return view ('monthlyBased');
    }

 /***********************************************Fetch Data***************************************************/   
    public function fetchData()     
      {
        $customers = DB::select('select * from customers');

        return view('customers',['customers'=>$customers]);
        //echo '<pre>'; print_r($customers); die;      
      }
 /************************************************************************************************************/
 /********************************************Monthly Based Data**********************************************/
 /************************************************************************************************************/
 public function getData()
 {
     $cname = $_POST['month_range'];                          //for month
     $yname = $_POST['year_range'];                           //for year
    //print_r ($yname); die;                       
     $customers = Customer::where('formonth',$cname)
        ->where('foryear', $yname)->get();

     
      //dd($customers->toArray());
      //return view('monthlyBased',['customers'=>$customers]);
      return response()->json(['success' => $customers]);
     
 }
 /*************************************************************************************************************/
 /**********************************************GET all invoice PDF*******************************************/
 /************************************************************************************************************/
 public function getPDF()
  { 
         set_time_limit(30000);
         $customers = new Customer;
         $monthrange = $_POST['month_range'];
         $yearrange = $_POST['year_range'];
         //print_r($_POST); die;
         $customers= Customer::where('formonth', $monthrange)
         ->where('foryear',$yearrange)->get();
          //echo '<pre>' ; print_r($customers); die; 
         //dd($customers->toArray()); die;
         $results = $customers->toArray();
         if(empty($results)){
            Session::flash('error', 'No data for this month');
            return redirect()->back();
             }else{
                 
           foreach($results as  $result){       
           //echo '<pre>'; print_r($result); die;
           new Customer ([
           'flat_no' =>$result['flat_no'],
           'pr_rd' =>$result['pr_rd'],
           'pr_rd_dt' =>$result['pr_rd_dt'],
           'cur_rd' =>$result['cur_rd'],
           'cur_rd_dt' =>$result['cur_rd_dt'],
           'cons_unt' =>$result['cons_unt'],
           'conv_fac' =>$result['conv_fac'],
           'unt_cons' =>$result['unt_cons'],
           'gas_rt' =>$result['gas_rt'],
           'amt' =>$result['amt'],
           'main_char' =>$result['main_char'],
           'lat_pay_char' =>$result['lat_pay_char'],
           'amt_last_p' =>$result['amt_last_p'],
           'cred_bal' =>$result['cred_bal'],
           'bal' =>$result['bal'],
           'npa' =>$result['npa'],
           'inv_n' =>$result['inv_n'],
           'inv_d' =>$result['inv_d'],
           'formonth' =>$result['formonth'],
           'foryear' =>$result['foryear'],
         ]);
  
          //print_r($result['inv_n']); die;
      
           $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
           <html xmlns="http://www.w3.org/1999/xhtml">
           <head>
           <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
           <title>Untitled Document</title>
           
           </head>
           <body style="font-size: 12px;">
               <table width="95%" border= "0" cellspacing="0" cellpadding="0">
                 <tr>
                     <td colspan="2" style="width:70%; border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;"><h4 style="margin-top: 3px; padding: 3px;"><u>IQBAL HP GAS SERVICE</u></h4>
                   <p style="margin-bottom: 3px; margin-top: -15px; padding: 3px;">9 Square Building, Sohana Landran Road, Sector 77, Mohali<br>
                       Phone No. +91 95920 27766<br>
                       GST No. 03AAIFI3598M1ZW</p></td>
                          <td style="width:30%; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"><h1 style=" font-style: italic; display: inline; margin-bottom: 2px; margin-right:10px;">PayHere</h1>
                           <img src="http://localhost/GAS%20BILLING%20AGENCY/public/code.jpg"  alt="" width="80" height="70" ></td>
                    </tr>
                    <tr>
                     <td style="width:30%; border-left: 1px solid black;  border-bottom: 1px solid black;"><p style="margin-top: 1px; margin-bottom: 2px; padding:3px;">Society:	Park View Residency<br>
                       Plot No.1, Sector 66<br>
                       Mohali</p></td>
                       <td style="width:35%; border-bottom: 1px solid black; "><label for="username">Flat No.</label> '.$result['flat_no'].'
                        
                       </td>
                        <td style="width:30%; border-bottom: 1px solid black; border-right: 1px solid black; ">
                           <table>
                            <tr>
                                <td><label for="username">Invoice No. :</label> '.$result['inv_n'].'
                          </td>
                           </tr>
                           <tr>
                               <td>
                           <label for="username">Invoice Date :<label> '.$result['inv_d'].'
                              
                           </tr></td> </table></td>
                       </tr> 
                        <tr>
                          <td style="width:35%; border-left: 1px solid black;"><table>
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
                                  </td>
                           </tr>
           
                        </table></td>
                        <td style="width:35%;">
                           <table>
                               <tr>
                                   <td><label style="text-align:right;" for="username">Conversion Factor:</label> '.$result['conv_fac'].'
                                     </td>
                               </tr>
                               <tr>
                                  <td><label style="text-align:left;" for="username">Meter Reading:</label> '.$result['cons_unt'].'
                                   </td>
                              </tr>
                              <tr>
                                  <td><label style="text-align:left;" for="username">Units Consumed (Kg/SCM):</label> '.$result['unt_cons'].'
                                     </td>
                              </tr>
                              <tr>
                                  <td><label style="text-align:left;" for="username">Rate Per Kg:</label> '.$result['gas_rt'].'
                                     </td>
                              </tr> </table> </td>
                             
                              <td style="width:30%; border-right: 1px solid black; text-align: right;">
                               <table>
                                   <tr>
                                       <td><label style="text-align:left;" for="username">Usage Amount:</label> '.$result['amt'].'
                                         </td>
                                   </tr>
                                   <tr>
                                      <td><label style="text-align:left;" for="username">Maintenance Charges:</label> '.$result['main_char'].'
                                        </td>
                                  </tr>
                                  <tr>
                                      <td><label style="text-align:left;" for="username">Late Payment Charges:</label> '.$result['lat_pay_char'].'
                                         </td>
                                  </tr>
                                  <tr>
                                      <td><label style="text-align:left;" for="username">Cheque Bounce Charges:</label> 
                                         <input style="border:none; outline:none; width:45%; font-size: 10px;" type="text"></td>
                                  </tr> </table>  </td>
                                </tr>   
                               <tr>
                                       <td colspan ="2" style="border-left: 1px solid black; border-bottom: 1px solid black; text-align: left;"><table>
                                           <tr>
                                               <td><label style="text-align:left;" for="username">Previous Reading:</label> '.$result['pr_rd'].'
                                                  </td>
                                           </tr>
                                           <tr>
                                              <td><label style="text-align:left;" for="username">Previous Reading Date:</label> '.$result['pr_rd_dt'].'
                                                 </td>
                                          </tr>
                                          <tr>
                                              <td><label style="text-align:left;" for="username">Current Reading:</label> '.$result['cur_rd'].'
                                               </td>
                                          </tr>
                                          <tr>
                                              <td><label style="text-align:left;" for="username">Current Reading Date</label> '.$result['cur_rd_dt'].'
                                                </td>
                                          </tr> </table> </td>
           
                                          
                                          <td style=" border-right: 1px solid black; border-bottom: 1px solid black; text-align: right;">
                                           <table>
                                               <tr>
                                                   <td><label style="text-align:left;" for="username">Last Payment:</label> '.$result['amt_last_p'].'
                                                      </td>
                                               </tr>
                                               <tr>
                                                  <td><label style="text-align:left;" for="username">Total Invoice Amount:</label> '.$result['bal'].'
                                                    
                                                   </td>
                                              </tr>
                                              <tr>
                                                  <td><label style="text-align:left;" for="username">Credit Balance:</label>  '.$result['cred_bal'].'
                                                    </td>
                                              </tr>
                                               </table></td>
                                   </tr>  
                               <tr>
                                   <td colspan="3" style="text-align:right; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">
                                       <label style="text-align:right;" for="username">Net Payable Amount:</label>  '.$result['npa'].'
                                        
                                   </td>
                               </tr>
                        
                               <tr>
                                   <td colspan="2" style="border-left:1px solid black; border-bottom: 1px  solid black;"><table>
                                       <ul>
                                           <li>Late Payment Charges @ 2% per month</li>
                                           <li>For Bill Payment call Mr. Sanjeev | Mob: +91 90229 78516</li>
                                           <li>GST Inclusive of 5%</li>
                                       </ul>
                                       <p style="margin-left:25px"><u><b>NEFT / IMPS:</b></u> Bank Account No.: 152505500710<br>
                                           Bank : ICICI Bank Limited | IFSC Code : ICIC0001525<br>
                                           Cheques in favour of IQBAL HP GAS SERVICE<br>
                                           </p>

                                   </table></td>
                                   <td style=" border-right: 1px solid black; border-bottom: 1px solid black;">
                                       <div class="box" style=" box-sizing: border-box;  margin-left: 5px; border: 1px solid black; width: 250px; height: 90px;">
                                           <h3 style=" margin-top: 1px; margin-bottom: 45px; margin-left: 10px;">For IQBAL HP GAS SERVICE</h3>
                                           <p style="text-align: end;">Authorized Signatory</p>
                                         </div>
                                   </td>
                               </tr> 
          </table>    
           </body>
           </html>';       
           $pdf = \App::make('dompdf.wrapper');
           $pdf->loadHTML($html);
           $pdf->setPaper('a5', 'landscape');
           $pdf->save(public_path().'/pdf/customer_'.$result['flat_no'].'.pdf')->stream('customer_'.$result['flat_no'].'.pdf');
           $pdf_name[] = 'customer_'.$result['flat_no'].'.pdf';
           // echo '<pre>'; print_r ($pdf); die;
          }
    
           $pdfMerger = PDFMerger::init(); 
           foreach($pdf_name as $pdf){
           $pdfMerger->addPDF(public_path().'/pdf/'.$pdf);
           }
           $pdfMerger->merge();
           $pdfMerger->save("All Customers.pdf", "browser");
           $file = new Filesystem;
           $file->cleanDirectory('pdf');
           
             }
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
     // echo'<pre>'; print_r($data); die;
 
    return view('single-Pdf',  ['customers' => $customers]);
  }


     public function invoicePDF()
     {
     $customers = new Customer;
     $monthrange = $_POST['month_range'];
     $yearrange = $_POST['year_range'];
     $flatno = $_POST['flat_no'];
   
     //echo'<pre>'; print_r($customers); die;
     $customers= Customer::where('formonth', $monthrange)
         ->where('foryear',$yearrange)
         ->where('flat_no', $flatno)->get();
     $results = $customers->toArray();
     if(empty($results)){
        Session::flash('error', 'No data for this month');
        return redirect()->back();
         }else{
     //echo'<pre>'; print_r( $results); die; 
     foreach($results as  $result){
        

      $html ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Untitled Document</title>
      
      </head>
      <body style="font-size: 12px;">
          <table width="95%" border= "0" cellspacing="0" cellpadding="0">
            <tr>
                <td colspan="2" style="width:70%; border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;"><h4 style="margin-top: 3px; padding: 3px;"><u>IQBAL HP GAS SERVICE</u></h4>
              <p style="margin-bottom: 3px; margin-top: -15px; padding: 3px;">9 Square Building, Sohana Landran Road, Sector 77, Mohali<br>
                  Phone No. +91 95920 27766<br>
                  GST No. 03AAIFI3598M1ZW</p></td>
                     <td style="width:30%; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"><h1 style=" font-style: italic; display: inline; margin-bottom: 2px; margin-right:10px;">PayHere</h1>
                      <img src="http://localhost/GAS%20BILLING%20AGENCY/public/code.jpg"  alt="" width="80" height="70" ></td>
               </tr>
               <tr>
                <td style="width:30%; border-left: 1px solid black;  border-bottom: 1px solid black;"><p style="margin-top: 1px; margin-bottom: 2px; padding:3px;">Society:	Park View Residency<br>
                  Plot No.1, Sector 66<br>
                  Mohali</p></td>
                  <td style="width:35%; border-bottom: 1px solid black; "><label for="username">Flat No.</label> '.$result['flat_no'].'
                   
                  </td>
                   <td style="width:30%; border-bottom: 1px solid black; border-right: 1px solid black; ">
                      <table>
                       <tr>
                           <td><label for="username">Invoice No. :</label> '.$result['inv_n'].'
                     </td>
                      </tr>
                      <tr>
                          <td>
                      <label for="username">Invoice Date :<label> '.$result['inv_d'].'
                         
                      </tr></td> </table></td>
                  </tr> 
                   <tr>
                     <td style="width:35%; border-left: 1px solid black;"><table>
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
                             </td>
                      </tr>
      
                   </table></td>
                   <td style="width:35%;">
                      <table>
                          <tr>
                              <td><label style="text-align:right;" for="username">Conversion Factor:</label> '.$result['conv_fac'].'
                                </td>
                          </tr>
                          <tr>
                             <td><label style="text-align:left;" for="username">Meter Reading:</label> '.$result['cons_unt'].'
                              </td>
                         </tr>
                         <tr>
                             <td><label style="text-align:left;" for="username">Units Consumed (Kg/SCM):</label> '.$result['unt_cons'].'
                                </td>
                         </tr>
                         <tr>
                             <td><label style="text-align:left;" for="username">Rate Per Kg:</label> '.$result['gas_rt'].'
                                </td>
                         </tr> </table> </td>
                        
                         <td style="width:30%; border-right: 1px solid black; text-align: right;">
                          <table>
                              <tr>
                                  <td><label style="text-align:left;" for="username">Usage Amount:</label> '.$result['amt'].'
                                    </td>
                              </tr>
                              <tr>
                                 <td><label style="text-align:left;" for="username">Maintenance Charges:</label> '.$result['main_char'].'
                                   </td>
                             </tr>
                             <tr>
                                 <td><label style="text-align:left;" for="username">Late Payment Charges:</label> '.$result['lat_pay_char'].'
                                    </td>
                             </tr>
                             <tr>
                                 <td><label style="text-align:left;" for="username">Cheque Bounce Charges:</label> 
                                    <input style="border:none; outline:none; width:45%; font-size: 10px;" type="text"></td>
                             </tr> </table>  </td>
                           </tr>   
                          <tr>
                                  <td colspan ="2" style="border-left: 1px solid black; border-bottom: 1px solid black; text-align: left;"><table>
                                      <tr>
                                          <td><label style="text-align:left;" for="username">Previous Reading:</label> '.$result['pr_rd'].'
                                             </td>
                                      </tr>
                                      <tr>
                                         <td><label style="text-align:left;" for="username">Previous Reading Date:</label> '.$result['pr_rd_dt'].'
                                            </td>
                                     </tr>
                                     <tr>
                                         <td><label style="text-align:left;" for="username">Current Reading:</label> '.$result['cur_rd'].'
                                          </td>
                                     </tr>
                                     <tr>
                                         <td><label style="text-align:left;" for="username">Current Reading Date</label> '.$result['cur_rd_dt'].'
                                           </td>
                                     </tr> </table> </td>
      
                                     
                                     <td style=" border-right: 1px solid black; border-bottom: 1px solid black; text-align: right;">
                                      <table>
                                          <tr>
                                              <td><label style="text-align:left;" for="username">Last Payment:</label> '.$result['amt_last_p'].'
                                                 </td>
                                          </tr>
                                          <tr>
                                             <td><label style="text-align:left;" for="username">Total Invoice Amount:</label> '.$result['bal'].'
                                               
                                              </td>
                                         </tr>
                                         <tr>
                                             <td><label style="text-align:left;" for="username">Credit Balance:</label>  '.$result['cred_bal'].'
                                               </td>
                                         </tr>
                                          </table></td>
                              </tr>  
                          <tr>
                              <td colspan="3" style="text-align:right; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;">
                                  <label style="text-align:right;" for="username">Net Payable Amount:</label>  '.$result['npa'].'
                                   
                              </td>
                          </tr>
                   
                          <tr>
                              <td colspan="2" style="border-left:1px solid black; border-bottom: 1px  solid black;"><table>
                                  <ul>
                                      <li>Late Payment Charges @ 2% per month</li>
                                      <li>For Bill Payment call Mr. Sanjeev | Mob: +91 90229 78516</li>
                                      <li>GST Inclusive of 5%</li>
                                  </ul>
                                  <p style="margin-left:25px"><u><b>NEFT / IMPS:</b></u> Bank Account No.: 152505500710<br>
                                      Bank : ICICI Bank Limited | IFSC Code : ICIC0001525<br>
                                      Cheques in favour of IQBAL HP GAS SERVICE<br>
                                      </p>

                              </table></td>
                              <td style=" border-right: 1px solid black; border-bottom: 1px solid black;">
                                  <div class="box" style=" box-sizing: border-box;  margin-left: 5px; border: 1px solid black; width: 250px; height: 90px;">
                                      <h3 style=" margin-top: 1px; margin-bottom: 45px; margin-left: 10px;">For IQBAL HP GAS SERVICE</h3>
                                      <p style="text-align: end;">Authorized Signatory</p>
                                    </div>
                              </td>
                                </tr> 
                </table>    
            </body>
            </html>';
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($html);
            $pdf->setPaper('a5', 'landscape');
            
            return $pdf->download('Flat no_'.$result['flat_no'].'.pdf');

         }
    }   
  }   
}
