@extends('layouts.main')
@section('main-container')
<style>
.monthdata{
	font-size: 11px;
	color: red;
}	
* {
  margin: 0;
  padding: 0;
}

.loader {
  display: none;
  top: 50%;
  left: 50%;
  position: absolute;
  transform: translate(-50%, -50%);
}

.loading {
  border: 2px solid #ccc;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  border-top-color: #1ecd97;
  border-left-color: #1ecd97;
  animation: spin 1s infinite ease-in;
  margin-right: 171px;
  margin-top: 26px;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}
</style>

	<!-- Content wrapper scroll start -->
    <div class="content-wrapper-scroll">
					<!-- Content wrapper start -->
					<div class="content-wrapper">
						<!-- Row start -->
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								<!-- Card start -->
								<div class="card">
									<form method="post" action="/get-pdf">
										@csrf
									<div class="card-body mt-4">

										<h3>Get Pdf</h3>
										
										<!-- Row start -->
										<div class="row gutters">
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
											<!-- Field wrapper start -->
											<div class="field-wrapper">
                                                  
												  <input type="month" id="monthyear" name="monthyear"
														min="2021-03" value="" placeholder="2010,00" style="width: 82%;">
														<div class="field-placeholder">YYYY-MM</div>
												 </div>

												<!-- Field wrapper end -->
												
											</div>
											<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
												
												
												<!-- Field wrapper start -->
												<button type="submit" id="monthlyBill" class="btn btn-primary" onclick="spinner()" style="margin-top: 6px;"> <i class="loading-icon fa fa-spinner fa-spin hide"></i><span class="btn-txt">Get Pdf</span></button>

                                <div class="loader">
                                <div class="loading">
                                </div>
                                </div>
												<!-- Field wrapper end -->
												
											</div>
										</div>
										<!-- Row end -->

									</div>                
								</div>
                                </form>
<script src="{{('https://code.jquery.com/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@if(Session::has('error'))
<script>
	swal("oops...", "No Data For This Month!!","error");
	//jQuery('#monthdata').html('No Data For This Month');
	//$("#monthdata").fadeOut(10000);
	</script>
	@endif

	<script type="text/javascript">
    function spinner() {
        document.getElementsByClassName("loader")[0].style.display = "block";
        $(".loader").fadeOut(90000);		

    }	
	
</script>  

@endsection