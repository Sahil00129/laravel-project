@extends('layouts.main')
@section('main-container')
<style>
.col-xl-4 {
    flex: 1 0 auto;
    width: 33.333333%;
}
.btne {
  border-radius: 2px;
  border: 1px solid transparent;
  font-size: 21px;
  font-weight: 400;
  padding: .594rem 1.25rem;
}
	</style>
				<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">

					<!-- Content wrapper start -->
					<div class="content-wrapper">

					           	<div class="card-body">
					         	<!-- Row start -->
								 <form method="post" enctype="multipart/form-data"  id="importCSV">
								@csrf
					            	<div class="row gutters">
											<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
												<div class="doc-block">
													<div class="doc-icon">
													<img src="img/docs/xlc.png" alt="Doc Icon">
													</div>
													<div class="doc-title">Upload CSV File</div>
													<!-- Button trigger modal -->
									    	<button type="button" class="btne btn-primary mt-2 btn-lg"       data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
									    	Import
									    	</button>

										<!-- Modal start -->
										<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered">
											  	<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalCenterTitle">Import</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">

												<!-- Field wrapper start -->
											<div class="field-wrapper">
													<select class="form-select" id="foryear" name="foryear">
													
														<option value="2020">2020</option>
														<option  selected value="2021">2021</option>
														<option value="2022">2022</option>
													</select>
													<div class="field-placeholder">Year</div>
												</div>
												<!-- Field wrapper end -->


														<!-- Field wrapper start -->
											<div class="field-wrapper">
													<select class="form-select" id="formonth" name="formonth">
													<option selected value="1" >January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
											        <option value="5">May</option>
											        <option value="6">June</option>
											        <option value="7">July</option>
											        <option value="8">August</option>
											        <option value="9">September</option>
											        <option value="10">October</option>
										            <option value="11">November</option>
											        <option value="12">December</option>
													</select>
													<div class="field-placeholder">Month</div>
												</div>
												<!-- Field wrapper end -->

												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<div class="input-group">									<label>Upload CSV File</labe>
														<input type="file" id="uploadFile" class="uploadFile" name="uploadFile" required="" accept=".csv"/>			</div>
													     </div>			
													  </div>
													<div class="modal-footer">
													
														<!-- Field wrapper start -->
												<div class="field-wrapper">
												<button type="submit" id="monthlyCSV" class="btn btn-primary">Import Data</button>
												</div>
												<!-- Field wrapper end -->
													</div>
													</form>
											  	</div>
											</div>
										</div>
									</div>
							</div>

<!--**************************************************************************************-->
                      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
												<div class="doc-block">
													<div class="doc-icon">
														<img src="img/docs/pdf.svg" alt="Doc Icon">
													</div>
													<div class="doc-title">PDF</div>
													<!-- Button trigger modal -->
										<button type="button" class="btne btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable">
											Get PDF
										</button>

										<!-- Modal start -->
										<div class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Download Pdf</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														
													<a href="{{url('/invoicepdf')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Singlel Pdf</a> ||
													<a href="{{url('/getpdf')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">All Pdf</a>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
														
													</div>
												</div>
											</div>
										</div>
										<!-- Modal end -->
												</div>
											</div>			
<!--******************************************************************************-->

                                      </div>
										
                         </div>

						<!-- Row end -->
						
					</div>
					<!-- Content wrapper end -->
     <script src="{{('https://code.jquery.com/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>  
<script src="{{('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js')}}" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	 <script>
		  
		  $(document).ready(function(){
			// alert('h');
			$('#importCSV').submit(function(e) {
		  //alert('hii');return false;
		 e.preventDefault();

				//alert (this);
				$.ajax({
					  url: "/upload-csv", 
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
</script>  

@if(Session::has('dataimported'))
<script>
	swal("Good job", "Data has been imported successfully!!","success");
</script>
	@endif

@if(Session::has('error'))
<script>
	swal("oops...", "Data Already Exists!!","error");
</script>
	@endif
	
@endsection