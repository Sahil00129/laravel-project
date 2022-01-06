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
            <form method="post" action="/invoice-pdf">
                @csrf
                <div class="card-body mt-4">

                    <h3>Single Pdf</h3>
                       
                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                            
                       	<!-- Field wrapper end -->

												<div class="field-wrapper">
                                                  
												  <input type="month" id="monthyear" name="monthyear"
														min="2021-03" value="" placeholder="2010,00" style="width: 82%;">
														<div class="field-placeholder">YYYY-MM</div>
												 </div>

                        </div>
                        <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                               <!-- Field wrapper start -->
                        <div class="field-wrapper">
   
                                <select class="form-select" id="flat_no" name="flat_no" style="width:27%;">

                              @foreach($customers as $customer)
                              <option value="{{$customer->flat_no}}">{{$customer->flat_no}}</option>
                              @endforeach
                                
                              </select>
                                <div class="field-placeholder">Flat No</div>
                            </div>

                         </div>
                            <!-- Field wrapper end -->
                            
                            <!-- Field wrapper start -->
                            <div class="field-wrapper">
                            <button type="submit" id="singleinvoice" class="btn btn-primary">Get Pdf</button>
                            </div>
                            <!-- Field wrapper end -->
                            </form>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>     
            </div>
            <script src="{{('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js')}}" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!--          <script src="{{('https://code.jquery.com/jquery-3.6.0.min.js')}}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>  
<script src="{{('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js')}}" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	 <script>
		  
		  $(document).ready(function(){
			//alert('h');
			$('#singlePDF').submit(function(e) {
		    //alert('hii');return false;
	         e.preventDefault();

				//alert (this);
				$.ajax({
					  url: "/invoice-pdf", 
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
</script>  -->
@if(Session::has('error'))
<script>
	swal("oops...", "No Data For This Month!!","error");
</script>
@endif

@endsection                                              