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
									<form method="post" enctype="multipart/form-data" action="{{route('imports')}}">
									@csrf
									<div class="card-body mt-4">

										<h3>Import Data</h3>
												
										<!-- Row start -->
										<div class="row gutters">
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
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

											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
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
												

											</div>
											<div class="row gutters">
					                		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
												<!-- Field wrapper start -->
												<div class="field-wrapper">
													<div class="input-group">									<label>Upload CSV File</labe>
														<input type="file" id="uploadFile" class="" name="uploadFile" required="" accept=".csv" />			</div>
													</div>
												</div>
												<!-- Field wrapper end -->
												
												<!-- Field wrapper start -->
												<div class="field-wrapper">
												<button type="submit" id="monthlyBill" class="btn btn-primary">Import Data</button>
												</div>
												<!-- Field wrapper end -->
												</form>
											</div>
										</div>
										<!-- Row end -->
									</div>     
								</div>
								<!-- Card end -->						
					<!-- Content wrapper end -->
					<script src="{{('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js')}}" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
		<!--	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>              
 
 <script>
 $(document).ready(function(){
	// alert ('hi'); 
	 $('#monthlyBill').click(function(e){
            e.preventDefault();
			//alert ('hi'); 
			var _token = $("input[name=_token]").val();  
          
	   var foryear = $("#foryear").val();
      
       var formonth= $("#formonth").val();
	  
	   var uploadFile = $("#uploadFile").val();
	  
	 });

 });  
 </script>  -->
@endsection