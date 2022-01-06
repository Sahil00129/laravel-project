<?php

namespace App\Imports;
  
use App\Models\Customer;
use App\Models\Master;
use App\Models\Reading;
use DB;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\concerns\WithHeadingRow;

class CustomersImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       

        if($_POST['itype'] == 1){
         
            $flat = DB::table('customers')
            ->where('flat_no', '=', $row['flat_no'])
            ->first();

        if(is_null($flat)) {
            // It does not exist - add to favorites button will show
            return new Customer([
                'flat_no' =>$row['flat_no'],  
                'conv_fac' =>$row['conv_fac'],
                'gas_rt' =>$row['gas_rt'],
                'main_char' =>$row['main_char'],          
     
            ]);
        }else{
            return $e;
        }
          
      }
    
        if($_POST['itype'] == 2){
            return new Reading ([
             'flat_no' =>$row['flat_no'],
             'pr_rd' => $row['pr_rd'],
             'pr_rd_dt' => $row['pr_rd_dt'],
             'monthyear' => $_POST['monthyear'],
         ]);
 
        }
        if($_POST['itype'] == 3){
            return new Master([
                'flat_no' =>$row['flat_no'],
                'cur_rd' =>$row['cur_rd'],
                'cur_rd_dt' =>$row['cur_rd_dt'],
                'lat_pay_char' =>$row['lat_pay_char'],
                'amt_last_p' =>$row['amt_last_p'],
                'cred_bal' =>$row['cred_bal'],
                'inv_n' =>$row['inv_n'],
                'inv_d' =>$row['inv_d'],
                'monthyear' => $_POST['monthyear'],
            ]);
        } 
      
       //$request = request()->all(); 
      // echo "<pre>"; print_r($row);die;

    }
}
