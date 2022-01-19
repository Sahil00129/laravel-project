@extends('layouts.main')
@section('main-container')

			<!-- Sidebar wrapper end -->

			<!-- *************
				************ Main container start *************
			************* -->
			

					<!-- Content wrapper start -->
					<div class="content-wrapper">

						<!-- Row start -->
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


							
	<!-- Button trigger modal -->
	
										<!-- Modal start -->
										<div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="staticBackdropLabel">Update Company </h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<form action="{{ url('updated-company')}}" method="POST">
													@csrf
													@method('PUT')
												<div class="modal-body">
													<input type="hidden" name="comp_id" id="comp_id" value=""/>
                                                
													<div class="row">
                                                    <div class="col">	
												<div class="field-wrapper">
													<input class="form-control" type="text" id="cmpyName" name="cmpyName" value="">
													<div class="field-placeholder">Company Name <span class="text-danger"></span></div>
													
												</div>
                                             </div>
											 <div class="col">
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="cmpyNo" name="cmpyNo">
													<div class="field-placeholder">Phone No<span class="text-danger"></span></div>
													
												</div>
                                                </div>
                                                </div>
												<div class="row">
                                                    <div class="col">	
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="gstNum" name="gstNum">
													<div class="field-placeholder">Gst No<span class="text-danger"></span></div>
													
												</div>
                                           </div>
                                        <div class="col">	
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="cmpyAddress" name="cmpyAddress">
													<div class="field-placeholder">Company Address<span class="text-danger"></span></div>
													
												</div>
                                             </div>
                                             </div>
											 <div class="row">
                                                    <div class="col">
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="bankName" name="bankName">
													<div class="field-placeholder">Bank Name<span class="text-danger"></span></div>
													
												</div>
                                            </div>
                                           <div class="col">
												<!-- Field wrapper end -->
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="bankAcc" name="bankAcc">
													<div class="field-placeholder">Bank Account No<span class="text-danger"></span></div>
													
												</div>
                                              </div>
                                              </div>
											  <div class="row">
                                              <div class="col">
												<!-- Field wrapper end -->
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="ifscCode" name="ifscCode">
													<div class="field-placeholder">IFSC Code<span class="text-danger"></span></div>
													
												</div>
                                             </div>
                                             <div class="col">
												<!-- Field wrapper end -->
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="billerName" name="billerName">
													<div class="field-placeholder">Name<span class="text-danger"></span></div>
													
												</div>
                                             </div>
                                             </div>
                                             <div class="row">
                                              <div class="col">
												<!-- Field wrapper end -->
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="payCall" name="payCall">
													<div class="field-placeholder">Payment Call No<span class="text-danger"></span></div>
													
												</div>
                                              </div>
                                              <div class="col">
												<!-- Field wrapper end -->
												<!-- Field wrapper end -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="society" name="society">
													<div class="field-placeholder">Society<span class="text-danger"></span></div>
													
												</div>
                                               </div>
                                               </div>
                                               <div class="row">
                                              <div class="col">
												<!-- Field wrapper end -->
													<!-- Field wrapper end -->
													<div class="field-wrapper">
													<input class="form-control" type="text" id="sector" name="sector">
													<div class="field-placeholder">Plot No./Sector<span class="text-danger"></span></div>
													
												</div>
                                               </div>
                                               <div class="col">
												<!-- Field wrapper end -->
													<!-- Field wrapper end -->
													<div class="field-wrapper">
													<input class="form-control" type="text" id="city" name="city">
													<div class="field-placeholder">City<span class="text-danger"></span></div>
													
												</div>
                                               </div>
                                               </div>
												<!-- Field wrapper end -->
												
												</div>
                                               
												<div class="modal-footer">
												<button type="submit" class="btn btn-primary">Update</button>
												</form>
												</div>
												</div>
											</div>
										</div>
										<!-- Modal end -->


										
								<!-- Card start -->
								<div class="card">
								<form method="post" enctype="multipart/form-data"  id="mastersImport">
						    		@csrf
									<div class="card-header">
										<div class="card-title"><h3>Company Setup</h3></div>
											<!-- Button trigger modal -->
											<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left:700px;">
											Imports Masters
										</button>

										<!-- Modal start -->
										<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Imports</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
											<!-- Field wrapper start -->
										    	<div class="field-wrapper">
													<select class="form-select" id="itype" name="itype" onchange="showresult(this.value)">
														<option selected disabled>--select type--</option>
														<option  value="1">Masters</option>
														<option value="2">Opening Reading</option>
				
													</select>
													<div class="field-placeholder">Import Type</div>
												</div>
												<!-- Field wrapper end -->
                                                <!-- Field wrapper end -->

												<div class="field-wrapper" id="monthyear">
                                                  
												  <input type="month" id="monthyear" name="monthyear"
														min="2021-03" value="" placeholder="2010,00" style="width: 82%;">
														<div class="field-placeholder" >YYYY-MM</div>
												 </div>

												 <!-- Field wrapper start -->
												<div class="field-wrapper">
													<div class="input-group">									<label>Upload XLSX File</labe>
														<input type="file" id="uploadFile" class="uploadFile" name="uploadFile" required="" accept=".xlsx"/>			</div>
													     </div>			
												

												<!-- Field wrapper start -->


												</div>
												<div class="modal-footer">
													<!-- Field wrapper start -->
												<div class="field-wrapper">
												<button type="submit" id="monthlyCSV" class="btn btn-primary">Import Data</button>
												</div>
												<!-- Field wrapper end -->
												</div>
												</div>
                                   </form>
											</div>
										</div>
										<!-- Modal end -->

										<!-- Button trigger modal -->
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
										Sample Download
										</button>

										<!-- Modal start -->
										<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="staticBackdropLabel">Sample File Download</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
												<a class="btn btn-primary" href="{{url('/sample-master')}}" role="button">Masters</a> ||
												<a class="btn btn-primary" href="{{url('/sample-opening')}}" role="button">Opening Reading</a> ||
												<a class="btn btn-primary" href="{{url('/sample-current')}}" role="button">current Reading</a>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

												</div>
												</div>
											</div>
										</div>
										<!-- Modal end -->
									</div>
									
									<div class="card-body">
										
										<!-- Row start -->
										<div class="row gutters">
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                            <form id="cmpSetup" method="post">
							             	@csrf
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="cmpyName" name="cmpyName" required>
													<div class="field-placeholder">Company Name <span class="text-danger"></span></div>
													
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="cmpyNo" name="cmpyNo" required>
													<div class="field-placeholder">Phone No. <span class="text-danger"></span></div>
													
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="gstNum" name="gstNum" required>
													<div class="field-placeholder">Gst No.</div>
												
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="cmpyAddress" name="cmpyAddress" required>
													<div class="field-placeholder">Company Address</div>
												</div>
												<!-- Field wrapper end -->
                                               
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="bankName" name="bankName" required>
													<div class="field-placeholder">Bank Name</div>
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="bankAcc" name="bankAcc" required>
													<div class="field-placeholder">Bank Account No.</div>
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="ifscCode" name="ifscCode" required>
													<div class="field-placeholder">IFSC Code</div>
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="billerName" name="billerName" required>
													<div class="field-placeholder">Name</div>
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<input class="form-control" type="text" id="payCall" name="payCall" required>
													<div class="field-placeholder">Payment Call No.</div>
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												
												<!-- Field wrapper start -->
												
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
												<div class="form-section-header">Society Address</div>
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<div class="input-group">
														<input class="form-control" type="text" id="society" name="society" required>
														
													</div>
													<div class="field-placeholder">Society </div>
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<div class="input-group">
														<input class="form-control" type="text" id="sector" name="sector" required>
														
													</div>
													<div class="field-placeholder">Plot No./Sector</div>
												</div>
												<!-- Field wrapper end -->

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<div class="input-group">
														<input class="form-control" type="text" id="city" name="city" required>
														
													</div>
													<div class="field-placeholder">City</div>
												</div>
												<!-- Field wrapper end -->

											</div>
										
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<button class="btn btn-primary" id="saveCmpy">Save</button>
											</div>
										</div>
										<!-- Row end -->
                               </form>
									</div>
								</div>
								<!-- Card end -->

                        <!--edit model-->
 
	             	
										

           <div id="success_message"></div>
								<!--table start  -->
								<div class="card">
								<table class="table" id="cmptable">
                 <thead>
                        <tr>
                         <th>Company Name</th>
                         <th>Company Number</th>
                         <th>Gst Number</th>
                         <th>Company Address</th> 
						 <th>Bank Name</th>
						 <th>Bank Account</th>
						 <th>IFSC Code</th>
						 <th>Name</th>
						 <th>For Payment Call</th>
						 <th>Society</th>
						 <th>Sector</th>
						 <th>City</th>
						 <th>Action</th>
						 <th></th>
						
                         
                       </tr>
                  </thead>
                  <tbody>
					  @foreach ($companys as $company)
                       <tr>
                        <td>{{$company->cmpyName}}</td>
						<td>{{$company->cmpyNo}}</td>
						<td>{{$company->gstNum}}</td>
						<td>{{$company->cmpyAddress}}</td>
						<td>{{$company->bankName}}</td>
						<td>{{$company->bankAcc}}</td>
						<td>{{$company->ifscCode}}</td>
						<td>{{$company->billerName}}</td>
						<td>{{$company->payCall}}</td>
						<td>{{$company->society}}</td>
						<td>{{$company->sector}}</td>
						<td>{{$company->city}}</td>
						<td><a href="delete/{{$company->id}}"  class="btn btn-danger btn-sm">Delete</a></td>
						<td>	<button type= "button" class="btn btn-warning editbtn btn-sm"  value="{{ $company->id }}">edit</button></td>

                      </tr>
					  @endforeach
                  </tbody>
                          </table>
						  
                                
                                    </div>

							</div>
						</div>
						<!-- Row end -->

					</div>
					

					<!-- Content wrapper end -->
<script src="{{('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js')}}" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="{{('https://code.jquery.com/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
 

 @if(Session::has('delete'))
<script>
	swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
  } else {
    swal("Your imaginary file is safe!");
  }
});
</script>
	@endif

<script>


     
     $(document).ready(function(){
       
  
			//alert('h');
			$('#cmpSetup').submit(function(e) {
		    e.preventDefault();
				//alert (this);

				$.ajax({
					  url: "/save-company", 
					  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					  type: 'POST',  
					  data:new FormData(this),
					  processData: false,
					  contentType: false,
					  success: function(response){
							 console.log(response);
							alert(response.success.messages);
						
							location.reload();
            	     }
				});
			});


		

		});

//fetch Data



    </script>
	 <script>
		  
		  $(document).ready(function(){
			// alert('h');
			$('#mastersImport').submit(function(e) {
		//alert('hii');return false; 
		 e.preventDefault();

				//alert (this);
				$.ajax({
					  url: "/upload-Masters", 
					  headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					  type: 'POST',  
					  data:new FormData(this),
					  processData: false,
					  contentType: false,
					  success: function(response){
							 //console.log(response);
							alert(response.success.messages);
							location.reload();
            		  }
				});
			});


			
		});
</script>  
<script>
function showresult(str) {
  if (str == "1") {
    $("#monthyear").css('display', 'none');
    return;
  }else{
    $("#monthyear").css('display', 'block'); 
    
  } 
}
//
$(document).ready(function() {
    $('#cmptable').DataTable( {
        "scrollX": true
    } );
} );

	</script>

<script>
	$(document).ready(function(){
		//alert('h');
		$(document).on('click','.editbtn', function(){
			var comp_id = $(this).val();
			//alert(comp_id);
			$('#editModal').modal('show');

			$.ajax({
				type: "GET",
				url: "/edit-company/"+comp_id,
				success: function(response){
					//console.log(response.company.cmpyName);
					$('#cmpyName').val(response.company.cmpyName);
					$('#cmpyNo').val(response.company.cmpyNo);
					$('#gstNum').val(response.company.gstNum);
					$('#cmpyAddress').val(response.company.cmpyAddress);
					$('#bankName').val(response.company.bankName);
					$('#bankAcc').val(response.company.bankAcc);
					$('#ifscCode').val(response.company.ifscCode);
					$('#billerName').val(response.company.billerName);
					$('#payCall').val(response.company.payCall);
					$('#society').val(response.company.society);
					$('#sector').val(response.company.sector);
					$('#city').val(response.company.city);
					$('#comp_id').val(comp_id);
				}
			})
		});
	});

	</script>

@if(Session::has('deleted'))
<script>
	swal("Deleted", "Data has been Deleted","success");
</script>
	@endif

  </script>
    @if(Session::has('updated'))
<script>
	swal("Updated", "Data has been successfully updated","success");
</script>
	@endif

@endsection