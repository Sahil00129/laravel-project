@extends('layouts.main')
@section('main-container')

				<!-- Content wrapper scroll start -->
				<div class="content-wrapper-scroll">

					<!-- Content wrapper start -->
					<div class="content-wrapper">

						<!-- Row start -->
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
								
								<div class="card">
									<div class="card-body">
										
										<div class="table-responsive">
											<table id="fixedHeader" class="table v-middle">
												<thead>
													<tr>
													<th>Flat NO.</th>
                                    <th>Previous Reading</th>
                                    <th>Previous Reading Date</th>
                                    <th>Current Reading</th>
                                    <th>Current Reading Date</th>
                                    <th>Meter Reading</th>
                                    <th>Conversion Factor</th>
                                    <th>Units Consumed</th>
                                    <th>Gas Rate</th>
                                    <th>Amount</th>
                                    <th>Maintenance Charges</th>
                                    <th>Late Payment Charges</th>
                                    <th>Last Payment</th>
                                    <th>Credit Balance</th>
                                    <th>Total Invoice Amount</th>
                                    <th>NPA</th>
                                    <th>Invoice No.</th>
                                    <th>Invoice Date</th>
													</tr>
												</thead>
												<tbody>
												@foreach ($customers as $customer)
										<tr>
												<td>{{$customer->flat_no}}</td>
												<td>{{$customer->pr_rd}}</td>
												<td>{{$customer->pr_rd_dt}}</td>
												<td>{{$customer->cur_rd}}</td>
												<td>{{$customer->cur_rd_dt}}</td>
												<td>{{$customer->cons_unt}}</td>
												<td>{{$customer->conv_fac}}</td>
												<td>{{$customer->unt_cons}}</td>
												<td>{{$customer->gas_rt}}</td>
												<td>{{$customer->amt}}</td>
												<td>{{$customer->main_char}}</td>
												<td>{{$customer->lat_pay_char}}</td>
												<td>{{$customer->amt_last_p}}</td>
												<td>{{$customer->cred_bal}}</td>
												<td>{{$customer->bal}}</td>
												<td>{{$customer->npa}}</td>
												<td>{{$customer->inv_n}}</td>
												<td>{{$customer->inv_d}}</td>
                                            </tr>
											@endforeach  
													
												</tbody>
								    	</table>
										</div>
									</div>
								</div>

							</div>
						</div>
						<!-- Row end -->

					</div>
					<!-- Content wrapper end -->


@endsection