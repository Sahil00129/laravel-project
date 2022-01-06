@extends('layouts.main')
@section('main-container')
		<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">
					<!-- Content wrapper start -->
					<div class="content-wrapper">
						<!-- Row start -->
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<!-- Card start -->
								<div class="card">
									<form>
									@csrf
									<div class="card-body mt-4">

										<h3>Get Monthly Based</h3>
										
										<!-- Row start -->
										<div class="row gutters">
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
					
											
											<div class="field-wrapper">
                                                  
                                                  <input type="month" id="monthyear" name="monthyear"
                                                        min="2021-03" value="">
                                                        <div class="field-placeholder">YYYY-MM</div>
														<div id="monthdata" class="monthdata"></div>
                                                 </div>	
												<!-- Field wrapper end -->
												<!-- Field wrapper end -->
									
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
													
												<!-- Field wrapper start -->
												<div class="field-wrapper">
												<button type="submit" class="btn btn-primary" id="monthlyBill" >View</button>
												</div>
												<!-- Field wrapper end -->
												
											</div>
										</div>
										<!-- Row end -->

									</div>                
								</div>
                                </form>
                                <!-- Row start -->
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

								<div class="card">
									<div class="card-body">										
										<div class="table-responsive">
											<table id="custom" class="table v-middle" >
												<thead>
													<tr>
													<th>Flat No.</th>
                                                     <th>Previous Reading</th>
                                                     <th>Previous Reading Date</th>
                                                     <th>Current Reading</th>
                                                     <th>Current Reading Date</th>
                                                     <th>Meter reading</th>
                                                     <th>Conversion Factor</th>
                                                     <th>Units Consumed</th>
                                                     <th>Gas Rate</th>
                                                     <th>Amount</th>
                                                     <th>Maintenance Charges</th>
                                                     <th>Late Payment Charges</th>
                                                     <th>Last Payment</th>
                                                     <th>Credit Balance</th>
                                                     <th>Total Invoice Amount</th>
                                                     <th>Net Payable Amount</th>
                                                     <th>Invoice No.</th>
                                                     <th>Invoice Date</th>
													</tr>
												</thead>	
												<tbody>
											
                                                </tbody>	
								          	</table>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Card end -->			
			<!-- Content wrapper end -->

<script src="{{('https://code.jquery.com/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>              

<script>
      $(document).ready(function(){
		$('#monthlyBill').click(function(e){
            e.preventDefault();
            var fd = new FormData();
            var _token = $("input[name=_token]").val();
            var monthyear = $("#monthyear").val();
            fd.append('monthyear', monthyear); 
            //fd.append('year_range', year_range);
            //alert(month_range+ year_range); return false;
            $.ajax({
                  url: "/getdata", 
                  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  type: 'POST', 
                  data: fd,
                  dataType: 'json',
                  processData: false,
                  contentType: false,
                  beforeSend:                      //reinitialize Datatables
                  function(){   
					$('#custom').dataTable().fnClearTable();             
                  $('#custom').dataTable().fnDestroy();                
						
               },
                  success: function(response){
				    	 console.log(response);		
						// alert(response.success.messages);
                      // $.each(success,function(key, value){                     //jquery foreach
                      $.each(response.response, function(key, value){                   //object break
                      //alert(JSON.stringify(value) );
						        
                       $('#custom tbody').append("<tr><td>" + value.flat_no + "</td><td>" + value.pr_rd + "</td><td>" + value.pr_rd_dt +"</td><td>"+ value.cur_rd+"</td><td>"+ value.cur_rd_dt +"</td><td>"+ value.cons_unt +"</td><td>"+ value.conv_fac +"</td><td>"+ value.unt_cons +"</td><td>"+ value.gas_rt +"</td><td>"+ value.amt +"</td><td>"+  value.main_char +"</td><td>" + value.lat_pay_char +"</td><td>" + value.amt_last_p +"</td><td>" + value.cred_bal +"</td><td>" + value.bal +"</td><td>" + value.npa +"</td><td>" + value.inv_n +"</td><td>" + value.inv_d +"</td></tr>");
                        });
			

	    	$(function(){
	        $('#custom').DataTable({
				
		       "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50, "All"]],
		        dom: 'Bfrtip',
	        	buttons: [
		    	'copyHtml5',
		    	'excelHtml5',
		    	'csvHtml5',	
		    	'print'
	        	],    
	         });
          });
            //});             
                }                
                });
            });
        });
 </script>

@if(Session::has('error'))
<script>
	swal("oops...", "No Data For This Month!!","error");
</script>
@endif	

@endsection